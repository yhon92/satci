<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Category;

class CategoryRepo extends BaseRepo
{

  public function getModel()
  {
    return new Category;
  }

  public function all()
  {
    return Category::orderby('name', 'ASC')->get();
  }

  public function getListCategories()
  {
    return Category::has('themes')
    ->with('themes')
    ->get();
  }

  public function newCategory()
  {
    $theme = new Category();
  }

  static public function get($id)
  {
    return Category::find($id);
  }

}