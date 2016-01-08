<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Solicitude extends Model implements LogsActivityInterface
{
  use LogsActivity;

  protected $table = 'solicitudes';

  protected $fillable = ['id',
                          'solicitude_number', 
                          'reception_date', 
                          'applicant_type', 
                          'applicant_id', 
                          'document_date', 
                          'topic', 
                          'status'];

  protected $hidden = ['applicant_id',/* 'applicant_type'*/];
  
  public function applicant()
  {
    return $this->morphTo();
  }

  public function assigned()
  {
    return $this->hasMay(AssignSolicitude::class);
  }

  /**
 * Get the message that needs to be logged for the given event name.
 *
 * @param string $eventName
 * @return string
 */
  public function getActivityDescriptionForEvent($eventName)
  {
    if ($eventName == 'created')
    {
      return 'Solicitud "' . $this->solicitude_number . '" fue creado';
    }

    if ($eventName == 'updated')
    {
      return 'Solicitud "' . $this->solicitude_number . '" fue actualizado';
    }

    if ($eventName == 'deleted')
    {
      return 'Solicitud "' . $this->solicitude_number . '" fue eliminado';
    }

    return '';
  }
  
}
