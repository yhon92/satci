<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Solicitude;

class SolicitudeRepo extends BaseRepo
{

  public function getModel()
  {
    return new Solicitude;
  }

  public static function create($data)
  {
    return Solicitude::create($data);
  }

  public static function get($id)
  {
    return Solicitude::with('applicant')->find($id);
  }

  public static function update($id, $data)
  {
    return Solicitude::where('id', $id)->update($data);
  }

  public static function updateStatus($id, $data)
  {
    return Solicitude::where('id', $id)->update(['status' => $data]);
  }

  public static function getListSolicitudes()
  {
    return Solicitude::with('applicant')->get();
  }

  public static function getApplicant($type, $id){
    return $type::find($id);
  }

  public static function getListByApplicant($type)
  {
    return Solicitude::with('applicant')
    ->where('applicant_type', $type)
    ->orderBy('solicitude_number', 'DESC')
    ->get();
  }

  public static function count()
  {
    return Solicitude::count();
  }


}