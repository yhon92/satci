<?php
namespace SATCI\Http\Controllers;

use Cache;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Log;
use SATCI\Http\Controllers\Controller;
use SATCI\Http\Requests\CreateThemeRequest;
use SATCI\Http\Requests\EditThemeRequest;
use SATCI\Repositories\ThemeRepo;

class ThemeController extends Controller
{
  protected $themeRepo;

  public function __construct (ThemeRepo $themeRepo)
  {
    $this->middleware('jwt.auth');
    $this->themeRepo = $themeRepo;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (!Cache::has('themes')) {
      $themes = $this->themeRepo->all();

      Cache::forever('themes', $themes);
    } else {
      $themes = Cache::get('themes');
    }
    
    return response()->json(['themes' => $themes], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateThemeRequest $request)
  {
    $theme = $this->themeRepo->create($request->all());

    Cache::forget('themes');
    Cache::forget('categories');

    return response()->json(['success' => true, 'theme' => $theme], 200);
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
  public function update($id, EditThemeRequest $request)
  {
    try {
      $this->themeRepo->update($id, $request->all());
    } catch (QueryException $e) {
      Log::info($e->errorInfo[2]);

      return response()->json(['error' => true], 200);
    }
    Cache::forget('themes');
    Cache::forget('categories');

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
    $solicitudes = $this->themeRepo->getListSolicitudes($id);

    if (count($solicitudes->assign_solicitude)) {
      return response()->json(['conflict' => true], 200);
    } else {
      DB::beginTransaction();

      try {
        $this->themeRepo->delete($id);
      } catch (QueryException $e) {
        DB::rollBack();

        Log::info($e->errorInfo[2]);

        return response()->json(['error' => true], 200);
      }
    }
    
    DB::commit();

    Cache::forget('themes');
    Cache::forget('categories');

    return response()->json(['success' => true], 200);
  }

  public function getListThemesOrderByCategory()
  {
    $themes = $this->themeRepo->getListThemes();

    return response()->json(['themes' => $themes], 200);
  }
}
