<?php 
namespace SATCI\Repositories;

use SATCI\Entities\AssignObservation;

class AssignObservationRepo extends BaseRepo
{

  public function getModel()
  {
    return new AssignObservation;
  }

  public static function create($data)
  {
    return AssignObservation::create($data);
  }

  public static function get($id)
  {
    return AssignObservation::find($id);
  }

  public static function update($id, $data)
  {
    $observation = AssignObservation::find($id);

    $observation->update($data);

    return true;
  }

  public static function getListAssignObservationes()
  {
    return AssignObservation::get();
  }

}