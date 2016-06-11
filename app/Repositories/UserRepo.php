<?php 
namespace SATCI\Repositories;

use Crypt;
use SATCI\Entities\User;

class UserRepo extends BaseRepo
{

  public function getModel()
  {
    return new User;
  }

  public static function create($data)
  {
    unset($data['password_confirmation']);

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

}