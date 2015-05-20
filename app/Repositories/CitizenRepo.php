<?php namespace SATCI\Repositories;

use SATCI\Entities\Citizen;

class CitizenRepo extends BaseRepo
{

	public function getModel()
	{
		return new Citizen;
	}

	public function getListCitizen()
	{
		return Citizen::
			orderby('full_name', 'ASC')
				->get();
			// ->paginate();
	}

	public function newCitizen()
	{
		$user = new Citizen();
	}

}