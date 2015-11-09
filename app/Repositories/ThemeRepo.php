<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Theme;

class ThemeRepo extends BaseRepo
{

  public function getModel()
  {
    return new Theme;
  }

  public function getListThemes()
  {
    return \DB::select('SELECT t.id, t.category_id, t.name FROM themes t INNER JOIN categories c ON (c.id = t.category_id) ORDER BY c.name');
    // return Theme::orderby('category_id', 'ASC')->get();
  }

  public function newTheme()
  {
    $theme = new Theme();
  }

  static public function get($id)
  {
    return Theme::find($id);
  }

}