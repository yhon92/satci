<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Category;

class CategoryRepo extends BaseRepo
{

  public function getModel()
  {
    return new Category;
  }

  public function getListCategories()
  {
    return Category::has('themes')
    ->with('themes')
    ->get();
      // orderby('first_name', 'ASC')
      // ->paginate();
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