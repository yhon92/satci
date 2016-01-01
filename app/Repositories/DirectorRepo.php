<?php 
namespace SATCI\Repositories;

use DB;

use SATCI\Entities\Director;

class DirectorRepo extends BaseRepo
{

  public function getModel()
  {
    return new Director;
  }

  public static function create($data)
  {
    return Director::create($data);
  }

  public static function get($id)
  {
    return Director::find($id);
  }

  public static function update($id, $data)
  {
    return Director::where('id', $id)->update($data);
  }

  public static function delete($id)
  {
    return Director::destroy($id);
  }

  public static function all()
  {
    return Director::orderBy('full_name', 'ASC')->get();
  }

  public static function themeBySolicitude($solicitude_id)
  {
    $themes = Director::whereHas('assign_solicitude', function($query) use ($solicitude_id){
      $query->where('solicitude_id', $solicitude_id);
    })
    ->with('assign_solicitude', 'assign_solicitude.area_means.area.director', 'assign_solicitude.area_means.means')
    ->get();

    return $themes;
  }

  public static function getListSolicitudes($id)
  {
    return Director::with('assign_solicitude')->find($id);
  }

}