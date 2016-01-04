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

  public static function create($data)
  {
    return Theme::create($data);
  }

  public static function get($id)
  {
    return Theme::find($id);
  }

  public static function update($id, $data)
  {
    return Theme::where('id', $id)->update($data);
  }

  public static function delete($id)
  {
    return Theme::destroy($id);
  }

  public static function all()
  {
    return Theme::orderBy('name', 'ASC')->get();
  }

  /*public static function getListThemes()
  {
    return DB::select('SELECT t.id, t.category_id, t.name FROM themes t INNER JOIN categories c ON (c.id = t.category_id) ORDER BY c.name, t.name');
  }*/

  public static function themeBySolicitude($solicitude_id)
  {
    return Theme::whereHas('assign_solicitude', function($query) use ($solicitude_id) {
                  $query->where('solicitude_id', $solicitude_id);
                })
                ->with(['assign_solicitude' => function ($query) use ($solicitude_id) {
                  $query->where('solicitude_id', $solicitude_id);
                }, 
                'assign_solicitude.area_means.area.director', 
                'assign_solicitude.area_means.means'
                ])
                ->get();
  }

  public static function getListSolicitudes($id)
  {
    return Theme::with('assign_solicitude')->find($id);
  }

}