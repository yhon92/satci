<?php 
namespace SATCI\Repositories;

use SATCI\Entities\User;

class UserRepo extends BaseRepo
{

  public function getModel()
  {
    return new User;
  }

  public static function create($data)
  {
    return User::create($data);
  }

  public static function get($id)
  {
    return User::find($id);
  }

  public static function update($id, $data)
  {
    $user = User::find($id);

    $user->update($data);

    return true;
  }

  public static function delete($id)
  {
    return User::destroy($id);
  }

  public static function all()
  {
    return User::orderBy('first_name', 'ASC')->with('roles', 'permissions')->get();
  }

  public static function listLog()
  {
    // return User::
  }

  public static function allRoles($id)
  {
    $user = User::find($id);

    return $user->getRoles();
  }

  public static function allPermissions($id)
  {
    $user = User::find($id);

    return $user->getPermissions();
  }

}