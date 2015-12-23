<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Citizen;

class CitizenRepo extends BaseRepo
{

  public function getModel()
  {
    return new Citizen;
  }

  static public function create($data)
  {
    return Citizen::create($data);
  }

  static public function get($id)
  {
    return Citizen::find($id);
  }

  static public function update($id, $data)
  {
    return Citizen::where('id', $id)->update($data);
  }

  static public function delete($id)
  {
    return Citizen::destroy($id);
  }

  static public function getListCitizens()
  {
    return Citizen::orderBy('full_name', 'ASC')
                  ->get();
                  // ->paginate();
  }

  static public function getListSolicitudes($id)
  {
    return Citizen::with('solicitudes')
                  ->where('id', $id)
                  ->get();
  }

  static public function count()
  {
    return Citizen::count();
  }

}