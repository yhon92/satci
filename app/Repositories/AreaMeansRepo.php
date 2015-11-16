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

}