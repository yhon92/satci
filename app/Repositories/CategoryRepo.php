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

  public static function update($id, $data)
  {
    $category = Category::find($id);
    
    $category->update($data);

    return true;
  }

  public static function delete($id)
  {
    return Category::destroy($id);
  }

  public static function all()
  {
    return Category::/*has('themes')*/
                    with(['themes' => function ($query) {
                     $query->orderBy('name', 'ASC');
                   }])
                   ->orderBy('name', 'ASC')
                   ->get();
  }

  public static function listOnlyCategories()
  {
    return Category::orderBy('name', 'ASC')->get();
  }

  public static function getListTheme($id)
  {
    return Category::with(['themes' => function ($query) {
                      $query->orderBy('name', 'ASC');
                    }])
                    ->find($id);
  }
}