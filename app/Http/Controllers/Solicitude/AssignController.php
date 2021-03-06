<?php
namespace SATCI\Http\Controllers\Solicitude;

use Activity;
use App;
use DB;
use Gate;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Log;
use Mail;
use SATCI\Http\Controllers\Controller;
use SATCI\Http\Requests\EditAssignSolicitudeRequest;
use SATCI\Repositories\AreaMeansRepo;
use SATCI\Repositories\AssignObservationRepo;
use SATCI\Repositories\AssignSolicitudeRepo;
use SATCI\Repositories\SolicitudeRepo;
use SATCI\Repositories\ThemeRepo;
use Uuid;

class AssignController extends Controller
{
  
  protected $areaMeansRepo;
  protected $assignRepo;
  protected $observationRepo;
  protected $solicitudeRepo;
  protected $themeRepo;

  public function __construct (
      AreaMeansRepo $areaMeansRepo, 
      AssignSolicitudeRepo $assignRepo,
      AssignObservationRepo $observationRepo,
      SolicitudeRepo $solicitudeRepo,
      ThemeRepo $themeRepo
    ) {
    $this->middleware('jwt.auth');
    
    $this->areaMeansRepo = $areaMeansRepo;
    $this->assignRepo = $assignRepo;
    $this->observationRepo = $observationRepo;
    $this->solicitudeRepo = $solicitudeRepo;
    $this->themeRepo = $themeRepo;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return 'Hola';
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = $request->all();
    
    $solicitude_id = $data['solicitude'];
    
    $themes = $data['themes'];
    
    $default_means = 1;

    DB::beginTransaction();
    foreach ($themes as $theme) {
      $theme_id = $theme['id'];

      $areas = $theme['areas'];

      foreach ($areas as $key => $area) {
        if (array_key_exists('meansSelected', $area)) {
          $area_means_id = $this->areaMeansRepo->getID($area['id'], $area['meansSelected']);
        } else {
          $area_means_id = $this->areaMeansRepo->getID($area['id'], $default_means);
        }
        $uuid = Uuid::generate(5, 'SATCI', Uuid::generate());

        $data = ['id' => $uuid->string,
                  'solicitude_id' => $solicitude_id,
                  'theme_id'      => $theme_id,
                  'area_means_id' => $area_means_id
                ];
        try {
          $assignment = $this->assignRepo->create($data);
          $assigned_theme = $assignment->theme;
          $assigned_area = collect($assignment->area_means->area->toArray());
          $assigned_area_director = collect($assignment->area_means->area->director->toArray());
          $solicitude = $assignment->solicitude;
          $applicant = $solicitude->applicant;

          $data_email = [
            'assignment' => $assignment->toArray(),
          ];

          if (filter_var($assigned_area->get('email'), FILTER_VALIDATE_EMAIL)) {
            $email = $assigned_area->get('email');
          } elseif (filter_var($assigned_area_director->get('email'), FILTER_VALIDATE_EMAIL)) {
            $email = $assigned_area_director->get('email');
          } else {
            throw new Exception('No hay correo electrénico asociado para el envio del email');
          }

          Mail::later(5, 'emails.assign_solicitude', $data_email, function($message) use ($solicitude, $email, $assigned_theme) {
            $message->subject('Asignación de Solicitud Nº '. $solicitude->solicitude_number .
              ' de Tema: ' . $assigned_theme->name);
            if (App::environment('production') and !config('app.debug')) {
              $message->to($email);
            } elseif (env('MAIL_ADDRESS_TEST', null)) {
              $message->to(env('MAIL_ADDRESS_TEST'));
            } else {
              $message->to(config('mail.from.address'));
            }
          });

        } catch (QueryException $e) {
          DB::rollBack();

          Log::info($e->errorInfo[2]);

          return response()->json(['error' => true], 200);
        } catch (Exception $e) {
          DB::rollBack();

          Log::info($e->errorInfo[2]);

          return response()->json(['error' => true], 200);
        }
      }
    }
    try {
      $this->solicitudeRepo->updateStatus($solicitude_id, 'Procesando');

      Activity::log('Solicitud "' . $solicitude_id . '" fue actualizado al Estado: "Procesando"');
    } catch (QueryException $e) {
      DB::rollBack();

      Log::info($e->errorInfo[2]);

      return response()->json(['error' => true], 200);
    }

    DB::commit();
    
    return response()->json(['success' => true], 200);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  // public function update($id, EditAssignSolicitudeRequest $request)
  public function update($id, Request $request)
  {
    $data = $request->all();
    $status = $data['update']['status'];

    DB::beginTransaction();
    try {
      $this->assignRepo->update($id, $data['update']);

      if ($status === 'Aceptado' || $status === 'Atendido' || $status === 'Rechazado') {
        $uuid = Uuid::generate(5, 'SATCI', Uuid::generate());
        
        $observation = ['id' => $uuid->string, 
                  'assign_solicitude_id' => $id, 
                  'status' => $status, 
                  'body' => $data['observation']];

        $observation = $this->observationRepo->create($observation);
      }

    } catch (QueryException $e) {
      DB::rollBack();

      Log::info($e->errorInfo[2]);

      return response()->json(['error' => true], 200);
    }
    $assigned = $this->assignRepo->listAssign($data['solicitude_id']);

    $update_status = true;

    foreach ($assigned as $key => $value) {
      if ($value['status'] != 'Atendido' && $value['status'] != 'Rechazado') {
        $update_status = false;
      }
    }

    if ($update_status) {
      try {

        $this->solicitudeRepo->updateStatus($data['solicitude_id'], 'Finalizado');

        Activity::log('Solicitud "' . $data['solicitude_id'] . '" fue actualizado al Estado: "Finalizado"');
      } catch (QueryException $e) {
        DB::rollBack();

        Log::info($e->errorInfo[2]);

        return response()->json(['error' => true], 200);
      }
    }
    DB::commit();
    if ($observation) {
      return response()->json(['success' => true, 'observation' => $observation], 200);
    }

    return response()->json(['success' => true], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }

  public function listBySolicitude($id)
  {
    $assigned = $this->themeRepo->themeBySolicitude($id);

    return response()->json(['assigned' => $assigned], 200);
  }

  public function updateObservation($id, Request $request)
  {
    try {
      $this->observationRepo->update($id, $request->all());
    } catch (QueryException $e) {
      Log::info($e->errorInfo[2]);

      return response()->json(['error' => true], 200);
    }

    return response()->json(['success' => true], 200);
  }

}
