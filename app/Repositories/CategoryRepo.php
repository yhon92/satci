<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Category;

class CategoryRepo extends BaseRepo
{

  public function getModel()
  {
    return new Category;
  }

  public static function create($data)
  {
    return Category::create($data);
  }

  public static function get($id)
  {
    return Category::find($id);
  }

  public static function all()
  {
    return Category::orderby('name', 'ASC')->get();
  }

  public static function getListCategories()
  {
    return Category::has('themes')
                   ->with('themes')
                   ->get();
  }

}