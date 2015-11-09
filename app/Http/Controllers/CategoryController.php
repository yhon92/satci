<?php
namespace SATCI\Http\Controllers;

use Illuminate\Http\Request;

// use SATCI\Http\Requests;
use SATCI\Http\Controllers\Controller;
use SATCI\Repositories\CategoryRepo;

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

    return response()->json([
      'categories' => $categories,
      ], 200
    );
  }

  public function listCategoriesWithThemes()
  {
    $categories = $this->categoryRepo->getListCategories();
    
    return response()->json([
      'categories' => $categories,
      ], 200
    );
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
      //
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
}
