<?php namespace SATCI\Repositories;

use SATCI\Entities\Citizen;

class CitizenRepo extends BaseRepo
{

	public function getModel()
	{
		return new Citizen;
	}

	public function getListCitizens()
	{
		return Citizen::
			orderBy('full_name', 'ASC')
				->get();
			// ->paginate();
	}

	public function newCitizen($data)
	{
		return Citizen::create($data);
	}

}