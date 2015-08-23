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
		/*return Solicitude::join('citizens', 'applicant_id' ,'=', 'citizens.id')
			->where('applicant_type' ,'=', 'Natural')
			->orderBy('solicitude_number', 'desc')
			->get();*/
		return Solicitude::all();
	}

	public function newSolicitude()
	{
		$solicitude = new Solicitude();
	}

}