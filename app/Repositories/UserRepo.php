<?php 
namespace SATCI\Repositories;

use SATCI\Entities\User;

class UserRepo extends BaseRepo
{

	public function getModel()
	{
		return new User;
	}

	public function getListUsers()
	{
		return User::
			orderby('first_name', 'ASC')
			->paginate();
	}

	public function newUser()
	{
		$user = new User();
	}

}