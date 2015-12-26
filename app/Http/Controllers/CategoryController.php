<?php
namespace SATCI\Http\Controllers;

use Illuminate\Http\Request;

// use SATCI\Http\Requests;
use SATCI\Http\Controllers\Controller;
use SATCI\Repositories\CategoryRepo;
use SATCI\Http\Requests\CreateCategoryRequest;

class CategoryController extends Controller
{
  
  protected $categoryRepo;

  public function __construct (CategoryRepo $categoryRepo)
  {
    // $this->middleware('jwt.auth');
    $this->categoryRepo = $categoryRepo;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $categories = $this->categoryRepo->all();

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
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
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

  public function listCategoriesWithThemes()
  {
    $categories = $this->categoryRepo->getListCategories();
    
    return response()->json(['categories' => $categories], 200);
  }

}
