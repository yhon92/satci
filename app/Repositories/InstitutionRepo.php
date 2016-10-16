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
    $institution = Institution::find($id);
    
    $institution->update($data);

    return true;
  }

  public static function delete($id)
  {
    return Institution::destroy($id);
  }

  public static function getListInstitutions($parish = 'all')
  {
    if ($parish === 'all' || empty($parish)) {
      return Institution::orderBy('parish_id', 'ASC')
                        ->orderBy('full_name', 'ASC')
                        ->get();  
    }
    
    return Institution::where('parish_id', $parish)
                  ->orderBy('full_name', 'ASC')
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