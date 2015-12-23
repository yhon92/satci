<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Solicitude;

class SolicitudeRepo extends BaseRepo
{

  public function getModel()
  {
    return new Solicitude;
  }

  static public function create($data)
  {
    return Solicitude::create($data);
  }

  public function get($id)
  {
    return Solicitude::with('applicant')->find($id);
  }

  static public function update($id, $data)
  {
    return Solicitude::where('id', $id)->update($data);
  }

  static public function updateStatus($id, $data)
  {
    return Solicitude::where('id', $id)->update(['status' => $data]);
  }

  static public function getListSolicitudes()
  {
    return Solicitude::with('applicant')->get();
  }

  static public function getApplicant($type, $id){
    return $type::find($id);
  }

  static public function getListByApplicant($type)
  {
    return Solicitude::with('applicant')
    ->where('applicant_type', $type)
    ->orderBy('solicitude_number', 'desc')
    ->get();
  }

  static public function count()
  {
    return Solicitude::count();
  }


}