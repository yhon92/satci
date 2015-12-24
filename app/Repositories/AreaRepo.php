<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Area;

class AreaRepo extends BaseRepo
{

  public function getModel()
  {
    return new Area;
  }

  public static function create($data)
  {
    return Area::create($data);
  }

  public static function get($id)
  {
    return Area::find($id);
  }

  public static function all()
  {
    return Area::orderby('name', 'ASC')->with('director', 'means')->get();
  }

  public static function getListArea()
  {
    return Area::get();
  }

}