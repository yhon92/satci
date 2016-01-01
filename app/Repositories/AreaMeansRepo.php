<?php 
namespace SATCI\Repositories;

use SATCI\Entities\AreaMeans;

class AreaMeansRepo extends BaseRepo
{

  public function getModel()
  {
    return new AreaMeans;
  }

  public static function get($id)
  {
    return AreaMeans::find($id);
  }

  public static function getID($area_id, $means_id)
  {
    $areaMeans = AreaMeans::where('area_id', $area_id)
                          ->where('means_id', $means_id)
                          ->get();
    
    return $areaMeans[0]->id;
  }

  public static function getListSolicitudes($id)
  {
    return AreaMeans::with('solicitude')
                    ->where('area_id', $id)
                    ->get();
  }

}