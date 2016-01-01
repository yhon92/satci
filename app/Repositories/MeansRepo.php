<?php 
namespace SATCI\Repositories;

use DB;

use SATCI\Entities\Means;

class MeansRepo extends BaseRepo
{

  public function getModel()
  {
    return new Means;
  }

  public static function create($data)
  {
    return Means::create($data);
  }

  public static function get($id)
  {
    return Means::find($id);
  }

  public static function update($id, $data)
  {
    return Means::where('id', $id)->update($data);
  }

  public static function delete($id)
  {
    return Means::destroy($id);
  }

  public static function all()
  {
    return Means::orderBy('name', 'ASC')->get();
  }

  public static function themeBySolicitude($solicitude_id)
  {
    $themes = Means::whereHas('assign_solicitude', function($query) use ($solicitude_id){
      $query->where('solicitude_id', $solicitude_id);
    })
    ->with('assign_solicitude', 'assign_solicitude.area_means.area.director', 'assign_solicitude.area_means.means')
    ->get();

    return $themes;
  }

  public static function getListSolicitudes($id)
  {
    return Means::with('assign_solicitude')->find($id);
  }

}