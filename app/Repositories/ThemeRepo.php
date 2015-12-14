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
    return \DB::select('SELECT t.id, t.category_id, t.name FROM themes t INNER JOIN categories c ON (c.id = t.category_id) ORDER BY c.name, t.name');
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

  static public function themeBySolicitude($solicitude_id)
  {
    $themes = Theme::has('assign_solicitude', '>', 1)
    // ->with(['assign_solicitude' => function($query, $solicitude_id = '1bb7bc17-be0b-5a4a-9c7a-0c2dad605914') {
    ->with(['assign_solicitude' => function($query) use ($solicitude_id){
      $query->where('solicitude_id', '=', $solicitude_id);
    } ,'assign_solicitude.area_means.area', 'assign_solicitude.area_means.means'])
    ->get();

    return $themes;
  }

}