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

  static public function newAssign($data)
  {
    return AssignSolicitude::create($data);
  }

  static public function listBySolicitude($id)
  {
    return AssignSolicitude::with('theme.category', 'area_means.area', 'area_means.means')
    ->where('solicitude_id', '=', $id)
    ->get();
  }
}