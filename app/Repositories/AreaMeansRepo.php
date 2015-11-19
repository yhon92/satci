<?php 
namespace SATCI\Repositories;

use SATCI\Entities\AreaMeans;

class AreaMeansRepo extends BaseRepo
{

  public function getModel()
  {
    return new AreaMeans;
  }

  static public function get($id)
  {
    return AreaMeans::find($id);
  }

  static public function getID($area_id, $means_id)
  {
    $areaMeans = AreaMeans::where('area_id', $area_id)
                          ->where('means_id', $means_id)
                          ->get();
    
    return $areaMeans[0]->id;
  }

}