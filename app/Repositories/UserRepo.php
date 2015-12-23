<?php 
namespace SATCI\Repositories;

use SATCI\Entities\User;

class UserRepo extends BaseRepo
{

  public function getModel()
  {
    return new User;
  }

  public function create($data)
  {
    return User::create($data);
  }

  public function getListUsers()
  {
    return User::
      orderby('first_name', 'ASC')
      ->paginate();
  }

}