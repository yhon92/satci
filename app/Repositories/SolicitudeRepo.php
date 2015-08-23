<?php namespace SATCI\Repositories;

use SATCI\Entities\Solicitude;

class SolicitudeRepo extends BaseRepo
{

	public function getModel()
	{
		return new Solicitude;
	}

	static public function getListSolicitudes()
	{
		return Solicitude::all();
	}

	static public function getApplicant($type, $id){
		return $type::find($id);
	}

	static public function getListByApplicant($type)
	{
		$type = 'SATCI\Entities\\'.$type;
		return Solicitude::
		// join('citizens', 'applicant_id' ,'=', 'citizens.id')
		where('applicant_type' ,'=', $type)
		->orderBy('solicitude_number', 'desc')
		->get();
	}

	static public function newSolicitude()
	{
		$solicitude = new Solicitude();
	}

}