<?php
namespace SATCI\Http\Controllers;

use Cache;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Log;
use SATCI\Http\Controllers\Controller;
use SATCI\Http\Requests\CreateCategoryRequest;
use SATCI\Http\Requests\EditCategoryRequest;
use SATCI\Repositories\CategoryRepo;

class CategoryController extends Controller
{
  
  protected $categoryRepo;

  public function __construct (CategoryRepo $categoryRepo)
  {
    $this->middleware('jwt.auth');
    $this->categoryRepo = $categoryRepo;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (!Cache::has('categories')) {
      $categories = $this->categoryRepo->all();
      
      Cache::forever('categories', $categories);
    } else {
      $categories = Cache::get('categories');
    }

    return response()->json(['categories' => $categories], 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateCategoryRequest $request)
  {
    $category = $this->categoryRepo->create($request->all());

    Cache::forget('categories');
    Cache::forget('categories_only');

    return response()->json(['success' => true, 'category' => $category], 200);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $category = $this->categoryRepo->getListTheme($id);

    return response()->json(['category' => $category[0]], 200);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update($id, EditCategoryRequest $request)
  {
    try {
      $this->categoryRepo->update($id, $request->all());
    } catch (QueryException $e) {
      Log::info($e->errorInfo[2]);

      return response()->json(['error' => true], 200);
    }
    Cache::forget('categories');
    Cache::forget('categories_only');

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
    $categories = $this->categoryRepo->getListTheme($id);

    if (count($categories->themes)) {
      return response()->json(['conflict' => true], 200);
    } else {
      DB::beginTransaction();

      try {
        $this->categoryRepo->delete($id);
      } catch (QueryException $e) {
        DB::rollBack();

        Log::info($e->errorInfo[2]);

        return response()->json(['error' => true], 200);
      }
    }
    
    DB::commit();

    Cache::forget('categories');
    Cache::forget('categories_only');

    return response()->json(['success' => true], 200);
  }

  public function listOnlyCategories()
  {
    if (!Cache::has('categories_only')) {
      $categories = $this->categoryRepo->listOnlyCategories();

      Cache::forever('categories_only', $categories);
    } else {
      $categories = Cache::get('categories_only');
    }
    
    return response()->json(['categories' => $categories], 200);
  }

}
