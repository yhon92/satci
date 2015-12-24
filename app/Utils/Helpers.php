<?php 
namespace SATCI\Utils;

use SATCI\Repositories\SolicitudeRepo;
use SATCI\Repositories\ParishRepo;

/**
* 
*/
class Helpers
{
	public static function isCheck(&$request, $InputName)
	{
		if ($request[$InputName]) {
			return $request[$InputName] = true;
    } else {
			return $request[$InputName] = false;
    }
	}

  public static function longApplicant(&$type)
  {
    $type = 'SATCI\Entities\\'.ucwords($type);

    return $type;
  }

  public static function shortApplicant(&$type)
  {
    if (strpos($type, 'Citizen')) {
      $type = 'Citizen';
    }
    if (strpos($type, 'Institution')) {
      $type = 'Institution';
    }

    return $type;
  }

  public static function concatApplicantsWithParish(&$solicitudes)
  {
    foreach ($solicitudes as $key => $value) {
      $id = $value->applicant->parish_id;
      
      $parish = ParishRepo::get($id);
      $value->applicant->parish = $parish;

      // exit($value->applicant);
      // unset($value->applicant['parish_id']);
      // unset($value['applicant_type'], $value['applicant_id']);
    }
    return $solicitudes;
  }

/*  public static function concatSolicitudeWithApplicant(&$solicitude)
  {
    $type = $solicitude->applicant_type;
    $id   = $solicitude->applicant_id;

    $applicant = SolicitudeRepo::getApplicant($type, $id);
    $solicitude->applicant = $applicant;
    
    unset($solicitude['applicant_id']);

    return $solicitude;
  }*/

  public static function concatApplicantWithParish(&$applicant)
  {
    $id = $applicant->parish_id;

    $parish = ParishRepo::get($id);
    $applicant->parish = $parish->name;

    unset($applicant['parish_id']);

    return $applicant;
  }

  public static function getSolicitudeNumber($lastSolicitude)
  {
    $nextSolicitude = $lastSolicitude + 1;
    
    return str_pad($nextSolicitude, 8, '0', STR_PAD_LEFT);
  }
}