<?php 
namespace SATCI\Repositories;

use DB;

use SATCI\Entities\Theme;

class ThemeRepo extends BaseRepo
{

  public function getModel()
  {
    return new Theme;
  }

  static public function create($data)
  {
    return Theme::create($data);
  }

  static public function get($id)
  {
    return Theme::find($id);
  }

  public function getListThemes()
  {
    return DB::select('SELECT t.id, t.category_id, t.name FROM themes t INNER JOIN categories c ON (c.id = t.category_id) ORDER BY c.name, t.name');
  }

  static public function themeBySolicitude($solicitude_id)
  {
    $themes = Theme::whereHas('assign_solicitude', function($query) use ($solicitude_id){
      $query->where('solicitude_id', $solicitude_id);
    })
    ->with('assign_solicitude', 'assign_solicitude.area_means.area.director', 'assign_solicitude.area_means.means')
    ->get();

    return $themes;
  }

}