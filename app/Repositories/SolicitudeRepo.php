<?php 
namespace SATCI\Repositories;

use SATCI\Entities\Solicitude;

class SolicitudeRepo extends BaseRepo
{

	public function getModel()
	{
		return new Solicitude;
	}

	public function getSolicitude($id)
	{
		$solicitude = Solicitude::with('applicant.parish')->find($id);
		return $solicitude;
	}

	static public function getListSolicitudes()
	{
		return Solicitude::with('applicant.parish')->get();
	}

	static public function getApplicant($type, $id){
		return $type::find($id);
	}

	static public function getListByApplicant($type)
	{
		return Solicitude::with('applicant')
		->where('applicant_type' ,'=', $type)
		->orderBy('solicitude_number', 'desc')
		->get();
	}

	static public function newSolicitude($data)
	{
		return Solicitude::create($data);
	}

	static public function lastSolicitude()
	{
		$solicitude = \DB::table('solicitudes')->count();
		return $solicitude;
	}

	static public function updateStatus($id, $data)
	{
		return Solicitude::where('id', $id)->update(['status' => $data]);
	}
}