<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Institution;

class InstitutionRepo extends BaseRepo
{

  public function getModel()
  {
    return new Institution;
  }

  static public function create($data)
  {
    return Institution::create($data);
  }

  static public function get($id)
  {
    return Institution::find($id);
  }

  static public function update($id, $data)
  {
    return Institution::where('id', $id)->update($data);
  }

  static public function delete($id)
  {
    return Institution::destroy($id);
  }

  static public function getListInstitutions()
  {
    return Institution::orderBy('full_name', 'ASC')
                      ->get();
      // ->paginate();
  }

  static public function getListSolicitudes($id)
  {
    return Institution::with('solicitudes')
                  ->where('id', $id)
                  ->get();
  }
}