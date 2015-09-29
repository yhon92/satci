<?php namespace SATCI\Utils;

use SATCI\Repositories\SolicitudeRepo;

/**
* 
*/
class Helpers
{
	static public function isCheck(&$request, $InputName)
	{
		if ($request[$InputName])
			return $request[$InputName] = true;
		else
			return $request[$InputName] = false;
	}

  static public function longApplicant(&$type)
  {
    $type = 'SATCI\Entities\\'.ucwords($type);
    return $type;
  }

  static public function concatSolicitudeWithApplicant(&$solicitudes)
  {
    foreach ($solicitudes as $key => $value) {
      $type = $value->applicant_type;
      $id   = $value->applicant_id;

      $applicant = SolicitudeRepo::getApplicant($type, $id);
      $value->applicant = $applicant;

      unset($value['applicant_type'], $value['applicant_id']);
    }
    return $solicitudes;
  }

  static public function getSolicitudeNumber($lastSolicitude)
  {
    $nextSolicitude = $lastSolicitude + 1;
    return str_pad($nextSolicitude, 8, '0', STR_PAD_LEFT);
  }
}