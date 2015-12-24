<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Parish;

class ParishRepo extends BaseRepo
{

  public function getModel()
  {
    return new Parish;
  }

  public static function create($data)
  {
    return Parish::create($data);
  }

  public static function get($id)
  {
    return Parish::find($id);
  }

  public static function getListParishes()
  {
    return Parish::get();
  }

}