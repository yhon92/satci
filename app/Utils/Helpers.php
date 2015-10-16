<?php namespace SATCI\Utils;

use SATCI\Repositories\SolicitudeRepo;
use SATCI\Repositories\ParishRepo;

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

  static public function shortApplicant(&$type)
  {
    if ( strpos($type, 'Citizen') )
    {
      $type = 'Citizen';
    }
    if ( strpos($type, 'Institution') )
    {
      $type = 'Institution';
    }
    return $type;
  }

  static public function concatSolicitudesWithApplicants(&$solicitudes)
  {
    foreach ($solicitudes as $key => $value) 
    {
      $type = $value->applicant_type;
      $id   = $value->applicant_id;

      $applicant = SolicitudeRepo::getApplicant($type, $id);
      $value->applicant = $applicant;

      unset($value['applicant_type'], $value['applicant_id']);
    }
    return $solicitudes;
  }

  static public function concatSolicitudeWithApplicant(&$solicitude)
  {
    $type = $solicitude->applicant_type;
    $id   = $solicitude->applicant_id;

    $applicant = SolicitudeRepo::getApplicant($type, $id);
    $solicitude->applicant = $applicant;
    
    unset($solicitude['applicant_id']);

    return $solicitude;
  }

  static public function concatApplicantWithParish(&$applicant)
  {
    $id = $applicant->parish_id;

    $parish = ParishRepo::get($id);
    $applicant->parish = $parish->name;

    unset($applicant['parish_id']);

    return $applicant;
  }

  static public function getSolicitudeNumber($lastSolicitude)
  {
    $nextSolicitude = $lastSolicitude + 1;
    return str_pad($nextSolicitude, 8, '0', STR_PAD_LEFT);
  }
}