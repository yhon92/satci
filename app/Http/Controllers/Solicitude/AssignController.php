<?php
namespace SATCI\Http\Controllers\Solicitude;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;

// use SATCI\Http\Requests;
use SATCI\Http\Controllers\Controller;
use SATCI\Repositories\AreaMeansRepo;
use SATCI\Repositories\AssignSolicitudeRepo;
use SATCI\Repositories\SolicitudeRepo;
use SATCI\Repositories\ThemeRepo;
use SATCI\Http\Requests\EditAssignSolicitudeRequest;

class AssignController extends Controller
{
  protected $areaMeansRepo;
  protected $assignRepo;
  protected $solicitudeRepo;
  protected $themeRepo;

  public function __construct (
      AssignSolicitudeRepo $assignRepo,
      AreaMeansRepo $areaMeansRepo, 
      SolicitudeRepo $solicitudeRepo,
      ThemeRepo $themeRepo
    )
  {
    $this->areaMeansRepo = $areaMeansRepo;
    $this->assignRepo = $assignRepo;
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
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
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
    foreach ($themes as $theme) 
    {
      $theme_id = $theme['id'];

      $areas = $theme['areas'];

      foreach ($areas as $key => $area) 
      {
        if (array_key_exists('meansSelected', $area))
        {
          $area_means_id = $this->areaMeansRepo->getID($area['id'], $area['meansSelected']);
        }
        else
        {
          $area_means_id = $this->areaMeansRepo->getID($area['id'], $default_means);
        }
        $uuid = \Uuid::generate(5, 'SATCI', \Uuid::generate());

        $data = ['id' => $uuid->string,
                  'solicitude_id' => $solicitude_id,
                  'theme_id'      => $theme_id,
                  'area_means_id' => $area_means_id
                ];
        try 
        {
          $this->assignRepo->newAssign($data);
        }
        catch (QueryException $e)
        {
          DB::rollBack();

          \Log::info($e->errorInfo[2]);

          return response()->json(['error' => true], 200);
        }
      }
    }
    try 
    {
      $this->solicitudeRepo->updateStatus($solicitude_id, 'Procesando');
    }
    catch (QueryException $e)
    {
      DB::rollBack();

      \Log::info($e->errorInfo[2]);

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
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
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
    
    try
    {
      $this->assignRepo->update($id, $data['update']);
    }
    catch (QueryException $e)
    {
      \Log::info($e->errorInfo[2]);
      return response()->json(['error' => true], 200);
    }

    $assigned = $this->assignRepo->listAssign($data['solicitude_id']);

    $update_status = true;

    foreach ($assigned as $key => $value) {
      if ($value['status'] != 'Atendido' && $value['status'] != 'Rechazado')
        $update_status = false;
    }

    if ($update_status) {
      try 
      {
        $this->solicitudeRepo->updateStatus($data['solicitude_id'], 'Finalizado');
      }
      catch (QueryException $e)
      {
        \Log::info($e->errorInfo[2]);

        return response()->json(['error' => true], 200);
      }
    }

    return response()->json(['success' => true]);
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

    return response()->json($assigned, 200);
  }
}
