<?php 
namespace SATCI\Repositories;

use DB;

use SATCI\Entities\Director;

class DirectorRepo extends BaseRepo
{

  public function getModel()
  {
    return new Director;
  }

  public static function create($data)
  {
    return Director::create($data);
  }

  public static function get($id)
  {
    return Director::with('areas')->find($id);
  }

  public static function update($id, $data)
  {
    $director = Director::find($id);
    
    $director->update($data);

    return true;
  }

  public static function delete($id)
  {
    return Director::destroy($id);
  }

  public static function listDirectors()
  {
    return Director::with('areas')->orderBy('full_name', 'ASC')->get();
  }

  public static function getListAreas($id)
  {
    return Director::with('areas')->find($id);
  }

}