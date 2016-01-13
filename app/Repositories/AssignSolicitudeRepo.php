<?php 
namespace SATCI\Repositories;

use SATCI\Entities\AssignSolicitude;

class AssignSolicitudeRepo extends BaseRepo
{

  public function getModel()
  {
    return new AssignSolicitude;
  }

  public static function get($id)
  {
    return AssignSolicitude::find($id);
  }

  public static function create($data)
  {
    return AssignSolicitude::create($data);
  }

  public static function update($id, $data)
  {
    $assign = AssignSolicitude::find($id);
    
    $assign->update($data);
    
    return true;
  }

  public static function listAssign($solicitude_id)
  {
    return AssignSolicitude::where('solicitude_id', $solicitude_id)
                           ->get();
  }
  
}