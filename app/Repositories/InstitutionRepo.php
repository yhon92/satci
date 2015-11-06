<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Institution;

class InstitutionRepo extends BaseRepo
{

	public function getModel()
	{
		return new Institution;
	}

	static public function getListInstitutions()
	{
		return Institution::with('parish')
		->orderby('full_name', 'ASC')
		->get();
			// ->paginate();
	}

	static public function newInstitution($data)
	{
		return Institution::create($data);
	}

}