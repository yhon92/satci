<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Area;

class AreaRepo extends BaseRepo
{

  public function getModel()
  {
    return new Area;
  }

  public function all()
  {
    return Area::orderby('name', 'ASC')->with('director', 'means')->get();
  }

  public function getListArea()
  {
    return Area::/*has('themes')
    ->with('themes')
    ->*/get();
  }

  public function newArea()
  {
    $theme = new Area();
  }

  static public function get($id)
  {
    return Area::find($id);
  }

}