<?php namespace SATCI\Repositories;

use SATCI\Entities\Solicitude;

class SolicitudeRepo extends BaseRepo
{

	public function getModel()
	{
		return new Solicitude;
	}

	public function getListSolicitudes()
	{
		return Solicitude::get();
			// orderby('full_name', 'ASC')
				// ->get();
			// ->paginate();
	}

	public function newSolicitude()
	{
		$solicitude = new Solicitude();
	}

}