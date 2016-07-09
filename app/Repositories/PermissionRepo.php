<?php 
namespace SATCI\Repositories;

use Johnnymn\Sim\Roles\Models\Permission;

class PermissionRepo extends BaseRepo
{

  public function getModel()
  {
    return new Permission;
  }

  public static function create($data)
  {
    return Permission::create($data);
  }

  public static function get($id)
  {
    return Permission::find($id);
  }

  public static function update($id, $data)
  {
    $user = Permission::find($id);

    $user->update($data);

    return true;
  }

  public static function delete($id)
  {
    return Permission::destroy($id);
  }

  public static function all()
  {
    return Permission::orderBy('first_name', 'ASC')->with('roles', 'permissions')->get();
  }

  public static function permissionForUser($user_id)
  {
    return Permission::where('user_id', $user_id)->get();
  }

}