<?php namespace SATCI\Repositories;

use SATCI\Entities\Institution;

class InstitutionRepo extends BaseRepo
{

	public function getModel()
	{
		return new Institution;
	}

	public function getListInstitutions()
	{
		return Institution::
			orderby('full_name', 'ASC')
				->get();
			// ->paginate();
	}

	public function newInstitution($data)
	{
		return Institution::create($data);
	}

}