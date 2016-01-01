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
    $means = $data['means'];
    unset($data['means']);

    $area = Area::create($data);
    $area->means()->sync($means);
    return $area;
  }

  public static function get($id)
  {
    return Area::with('director', 'means')->find($id);
  }

  public static function update($id, $data)
  {
    $means = $data['means'];
    unset($data['means']);

    $area = Area::find($id);

    $area->update($data);

    $area->means()->sync($means);

    return true;
  }

  public static function delete($id)
  {
    return Area::destroy($id);
  }

  public static function all()
  {
    return Area::orderBy('name', 'ASC')->with('director', 'means')->get();
  }

  public static function getListArea()
  {
    return Area::get();
  }

}