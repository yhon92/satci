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

  public static function getListUsers()
  {
    return User::
      orderby('first_name', 'ASC')
      ->paginate();
  }

}