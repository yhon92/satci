<?php namespace SATCI\Repositories;

use SATCI\Entities\User;

class UserRepo extends BaseRepo
{

	public function getModel()
	{
		return new User;
	}

	public function getListUsers()
	{
		$users = User::
			orderby('first_name', 'ASC')
			->paginate();

		return $users;
	}

}