<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Parish;

class ParishRepo extends BaseRepo
{

  public function getModel()
  {
    return new Parish;
  }

  public function create($data)
  {
    return Parish::create($data);
  }

  static public function get($id)
  {
    return Parish::find($id);
  }

  public function getListParishes()
  {
    return Parish::get();
  }

}