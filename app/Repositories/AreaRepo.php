<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Area;

class AreaRepo extends BaseRepo
{

  public function getModel()
  {
    return new Area;
  }

  public function create($data)
  {
    return Area::create($data);
  }

  static public function get($id)
  {
    return Area::find($id);
  }

  public function all()
  {
    return Area::orderby('name', 'ASC')->with('director', 'means')->get();
  }

  public function getListArea()
  {
    return Area::get();
  }

}