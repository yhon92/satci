<?php
namespace SATCI\Http\Controllers;

use Cache;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Log;
use SATCI\Http\Controllers\Controller;
use SATCI\Http\Requests\CreateMeansRequest;
use SATCI\Http\Requests\EditMeansRequest;
use SATCI\Repositories\MeansRepo;

class MeansController extends Controller
{
  protected $meansRepo;

  public function __construct (MeansRepo $meansRepo)
  {
    $this->middleware('jwt.auth');
    $this->meansRepo = $meansRepo;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (!Cache::has('means')) {
      $means = $this->meansRepo->all();

      Cache::forever('means', $means);
    } else {
      $means = Cache::get('means');
    }

    return response()->json(['means' => $means], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateMeansRequest $request)
  {
    $means = $this->meansRepo->create($request->all());
    
    Cache::forget('means');

    return response()->json(['success' => true, 'means' => $means], 200);
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
  public function update($id, EditMeansRequest $request)
  {
    try {
      $this->meansRepo->update($id, $request->all());
    } catch (QueryException $e) {
      Log::info($e->errorInfo[2]);

      return response()->json(['error' => true], 200);
    }
    
    Cache::forget('means');

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
    $means = $this->meansRepo->getListAreas($id);

    if (count($means->areas)) {
      return response()->json(['conflict' => true], 200);
    } else {
      DB::beginTransaction();

      try {
        $this->meansRepo->delete($id);
      } catch (QueryException $e) {
        DB::rollBack();

        Log::info($e->errorInfo[2]);

        return response()->json(['error' => true], 200);
      }
    }
    
    DB::commit();

    Cache::forget('means');

    return response()->json(['success' => true], 200);
  }

}
