<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Institution extends Model implements LogsActivityInterface
{
  use LogsActivity;

  protected $table = 'institutions';

  protected $fillable = ['identification',
                          'full_name',
                          'address',
                          'prefix_phone',
                          'number_phone',
                          'agent_identification',
                          'agent_full_name',
                          'agent_first_name',
                          'agent_last_name',
                          'parish_id'];

  protected $with = ['parish']; 

  protected $hidden = ['parish_id'];
  
  public function parish()
  {
    return $this->belongsTo(Parish::class);
  }

  public function solicitudes()
  {
    return $this->morphMany(Solicitude::class, 'applicant');
  }

  /**
 * Get the message that needs to be logged for the given event name.
 *
 * @param string $eventName
 * @return string
 */
  public function getActivityDescriptionForEvent($eventName)
  {
    if ($eventName == 'created') {
      return 'Institución "' . $this->full_name . '" fue creado';
    }

    if ($eventName == 'updated') {
      return 'Institución "' . $this->full_name . '" fue actualizado';
    }

    if ($eventName == 'deleted') {
      return 'Institución "' . $this->full_name . '" fue eliminado';
    }

    return '';
  }
  
}
