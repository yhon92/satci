<?php
namespace SATCI\Http\Controllers;

use Cache;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Log;
use SATCI\Http\Controllers\Controller;
use SATCI\Http\Requests\CreateAreaRequest;
use SATCI\Http\Requests\EditAreaRequest;
use SATCI\Repositories\AreaMeansRepo;
use SATCI\Repositories\AreaRepo;

class AreaController extends Controller
{

  protected $areaRepo;
  protected $areaMeansRepo;

  public function __construct(AreaRepo $areaRepo, AreaMeansRepo $areaMeansRepo) {
    $this->middleware('jwt.auth');
    $this->areaRepo = $areaRepo;
    $this->areaMeansRepo = $areaMeansRepo;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (!Cache::has('areas')) {
      $areas = $this->areaRepo->all();
      
      Cache::forever('areas', $areas);
    } else {
      $areas = Cache::get('areas');
    }

    return response()->json(['areas' => $areas], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateAreaRequest $request)
  {
    DB::beginTransaction();
    try {
      $area = $this->areaRepo->create($request->all());
    } catch (QueryException $e) {
      DB::rollBack();
      
      Log::info($e->errorInfo[2]);

      return response()->json(['error' => true], 200);
    }
    DB::commit();

    Cache::forget('areas');

    $area = $this->areaRepo->get($area->id);

    return response()->json(['success' => true, 'area' => $area], 200);
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
  public function update($id, EditAreaRequest $request)
  {
    try {
      $this->areaRepo->update($id, $request->all());
    } catch (QueryException $e) {
      Log::info($e->errorInfo[2]);

      return response()->json(['error' => true], 200);
    }
    Cache::forget('areas');

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
    $solicitudes = $this->areaMeansRepo->getListSolicitudes($id);

    $count = 0;

    foreach ($solicitudes as $key => $value) {
      $count += count($value->solicitude);
    }

    if ($count) {
      return response()->json(['conflict' => true], 200);
    } else {
      DB::beginTransaction();

      try {
        $this->areaRepo->delete($id);
      } catch (QueryException $e) {
        DB::rollBack();

        Log::info($e->errorInfo[2]);

        return response()->json(['error' => true], 200);
      }
    }
    
    DB::commit();
    
    Cache::forget('areas');

    return response()->json(['success' => true], 200);
  }
  
}
