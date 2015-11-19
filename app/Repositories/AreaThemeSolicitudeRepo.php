<?php 
namespace SATCI\Repositories;

use SATCI\Entities\AreaThemeSolicitude;

class AreaThemeSolicitudeRepo extends BaseRepo
{

  public function getModel()
  {
    return new AreaThemeSolicitude;
  }

  static public function get($id)
  {
    return AreaThemeSolicitude::find($id);
  }

  static public function newAssign($data)
  {
    return AreaThemeSolicitude::create($data);
  }
}