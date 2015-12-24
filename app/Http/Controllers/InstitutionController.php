<?php 
namespace SATCI\Http\Controllers;

use DB;
use Log;

use SATCI\Http\Controllers\Controller;
use SATCI\Http\Requests\CreateInstitutionRequest;
use SATCI\Http\Requests\EditInstitutionRequest;
use SATCI\Repositories\InstitutionRepo;

use Illuminate\Http\Request;

class InstitutionController extends Controller
{

  protected $institutionRepo;

  public function __construct (InstitutionRepo $institutionRepo)
  {
    // $this->middleware('jwt.auth');
    $this->institutionRepo = $institutionRepo;
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $institutions = $this->institutionRepo->getListInstitutions();

    return response()->json(['institutions' => $institutions], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(CreateInstitutionRequest $request)
  {
    
    $institution = $this->institutionRepo->create($request->all());

    return response()->json([
        'success' => true,
        'institution' => $institution,
      ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    $institution = $this->institutionRepo->get($id);

    return response()->json(['institution' => $institution], 200);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id, EditInstitutionRequest $request)
  {
    try {
      $this->institutionRepo->update($id, $request->all());
    } catch (QueryException $e) {
      Log::info($e->errorInfo[2]);
      
      return response()->json(['error' => true], 200);
    }

    return response()->json(['success' => true], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $solicitudes = $this->institutionRepo->getListSolicitudes($id);

    if (count($solicitudes[0]->solicitudes)) {
      return response()->json(['conflict' => true], 200);
    } else {
      DB::beginTransaction();

      try {
        $this->institutionRepo->delete($id);
      } catch (QueryException $e) {
        DB::rollBack();

        Log::info($e->errorInfo[2]);

        return response()->json(['error' => true], 200);
      }
    }
    
    DB::commit();

    return response()->json(['success' => true] ,200);
  }

}
