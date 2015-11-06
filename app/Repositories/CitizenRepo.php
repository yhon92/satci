<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Citizen;

class CitizenRepo extends BaseRepo
{

	public function getModel()
	{
		return new Citizen;
	}

	static public function getListCitizens()
	{
		return Citizen::with('parish')
		->orderBy('full_name', 'ASC')
		->get();
			// ->paginate();
	}

	static public function newCitizen($data)
	{
		return Citizen::create($data);
	}

}