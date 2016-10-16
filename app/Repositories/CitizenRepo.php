<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Citizen;

class CitizenRepo extends BaseRepo
{

  public function getModel()
  {
    return new Citizen;
  }

  public static function create($data)
  {
    return Citizen::create($data);
  }

  public static function get($id)
  {
    return Citizen::find($id);
  }

  public static function update($id, $data)
  {
    $citizen = Citizen::find($id);
    
    $citizen->update($data);

    return true;
  }

  public static function delete($id)
  {
    return Citizen::destroy($id);
  }

  public static function getListCitizens($parish = 'all')
  {
    if ($parish === 'all' || empty($parish)) {
      return Citizen::orderBy('parish_id', 'ASC')
                    ->orderBy('full_name', 'ASC')
                    ->get();  
    }

    return Citizen::where('parish_id', $parish)
                  ->orderBy('full_name', 'ASC')
                  ->get();
                  // ->paginate();
  }

  public static function getListSolicitudes($id)
  {
    return Citizen::with('solicitudes')
                  ->where('id', $id)
                  ->get();
  }

  public static function count()
  {
    return Citizen::count();
  }

}