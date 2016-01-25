<?php
namespace SATCI\Http\Controllers;

use Cache;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Log;
use SATCI\Http\Controllers\Controller;
use SATCI\Http\Requests\CreateDirectorRequest;
use SATCI\Http\Requests\EditDirectorRequest;
use SATCI\Repositories\DirectorRepo;

class DirectorController extends Controller
{
  protected $directorRepo;

  public function __construct (DirectorRepo $directorRepo)
  {
    $this->middleware('jwt.auth');
    $this->directorRepo = $directorRepo;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (!Cache::has('directors')) {
      $directors = $this->directorRepo->all();

      Cache::forever('directors', $directors);
    } else {
      $directors = Cache::get('directors');
    }

    return response()->json(['directors' => $directors], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateDirectorRequest $request)
  {
    $director = $this->directorRepo->create($request->all());

    Cache::forget('directors');

    return response()->json(['success' => true, 'director' => $director], 200);
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
  public function update($id, EditDirectorRequest $request)
  {
    try {
      $this->directorRepo->update($id, $request->all());
    } catch (QueryException $e) {
      Log::info($e->errorInfo[2]);

      return response()->json(['error' => true], 200);
    }
    Cache::forget('directors');

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
    $director = $this->directorRepo->get($id);

    if (count($director->areas)) {
      return response()->json(['conflict' => true], 200);
    } else {
      DB::beginTransaction();

      try {
        $this->directorRepo->delete($id);
      } catch (QueryException $e) {
        DB::rollBack();

        Log::info($e->errorInfo[2]);

        return response()->json(['error' => true], 200);
      }
    }
    
    DB::commit();

    Cache::forget('directors');

    return response()->json(['success' => true], 200);
  }

}
