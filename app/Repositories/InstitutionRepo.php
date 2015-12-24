<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Institution;

class InstitutionRepo extends BaseRepo
{

  public function getModel()
  {
    return new Institution;
  }

  public static function create($data)
  {
    return Institution::create($data);
  }

  public static function get($id)
  {
    return Institution::find($id);
  }

  public static function update($id, $data)
  {
    return Institution::where('id', $id)->update($data);
  }

  public static function delete($id)
  {
    return Institution::destroy($id);
  }

  public static function getListInstitutions()
  {
    return Institution::orderBy('full_name', 'ASC')
                      ->get();
      // ->paginate();
  }

  public static function getListSolicitudes($id)
  {
    return Institution::with('solicitudes')
                  ->where('id', $id)
                  ->get();
  }
}