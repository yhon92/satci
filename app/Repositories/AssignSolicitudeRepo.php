<?php 
namespace SATCI\Repositories;

use SATCI\Entities\AssignSolicitude;

class AssignSolicitudeRepo extends BaseRepo
{

  public function getModel()
  {
    return new AssignSolicitude;
  }

  static public function get($id)
  {
    return AssignSolicitude::find($id);
  }

  static public function create($data)
  {
    return AssignSolicitude::create($data);
  }

  static public function update($id, $data)
  {
    return AssignSolicitude::where('id', $id)->update($data);
  }

  static public function listAssign($solicitude_id)
  {
    return AssignSolicitude::where('solicitude_id', $solicitude_id)
                           ->get();
  }
}