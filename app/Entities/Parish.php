<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Parish extends Model implements LogsActivityInterface
{
  use LogsActivity;

  protected $table = 'parishes';

  protected $fillable = ['id', 'name'];

  protected $hidden = ['created_at', 'updated_at'];
  
  public function citizens()
  {
    return $this->hasMany(Citizen::class);
  }

  public function institutions()
  {
    return $this->hasMany(Institution::class);
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
      return 'Parroquia "' . $this->name . '" fue creado';
    }

    if ($eventName == 'updated')
    {
      return 'Parroquia "' . $this->name . '" fue actualizado';
    }

    if ($eventName == 'deleted')
    {
      return 'Parroquia "' . $this->name . '" fue eliminado';
    }

    return '';
  }
  
}
