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
    $means = Means::find($id);
    
    $means->update($data);

    return true;
  }

  public static function delete($id)
  {
    return Means::destroy($id);
  }

  public static function all()
  {
    return Means::with('areas')->orderBy('name', 'ASC')->get();
  }

  public static function getListAreas($id)
  {
    return Means::with('areas')->find($id);
  }

}