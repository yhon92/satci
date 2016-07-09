<?php 
namespace SATCI\Repositories;

use Johnnymn\Sim\Roles\Models\Role;

class RoleRepo extends BaseRepo
{

  public function getModel()
  {
    return new Role;
  }

  public static function create($data)
  {
    return Role::create($data);
  }

  public static function get($id)
  {
    return Role::find($id);
  }

  public static function update($id, $data)
  {
    $user = Role::find($id);

    $user->update($data);

    return true;
  }

  public static function delete($id)
  {
    return Role::destroy($id);
  }

  public static function all()
  {
    return Role::orderBy('first_name', 'ASC')->with('roles', 'permissions')->get();
  }

  public static function roleForUser()
  {
    return Role::where('')->get();
  }
}