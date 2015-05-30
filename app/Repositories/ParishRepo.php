<?php namespace SATCI\Repositories;

use SATCI\Entities\Parish;

class ParishRepo extends BaseRepo
{

	public function getModel()
	{
		return new Parish;
	}

	public function getListParishes()
	{
		return Parish::get();
			// orderby('first_name', 'ASC')
			// ->paginate();
	}

	public function newParish()
	{
		$parish = new Parish();
	}

}