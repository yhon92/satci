<?php namespace SATCI\Repositories;

use SATCI\Entities\Institution;

class InstitutionRepo extends BaseRepo
{

	public function getModel()
	{
		return new Institution;
	}

	public function getListInstitution()
	{
		return Institution::
			orderby('full_name', 'ASC')
				->get();
			// ->paginate();
	}

	public function newInstitution()
	{
		$user = new Institution();
	}

}