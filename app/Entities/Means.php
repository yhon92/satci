<?php
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Means extends Model implements LogsActivityInterface
{
  use LogsActivity;

  protected $table = 'means';
  
  protected $fillable = ['name'];
  
  protected $hidden = [/*'pivot',*/ 'created_at', 'updated_at'];

  public function areas()
  {
    return $this->belongsToMany(Area::class);
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
      return 'Recurso "' . $this->name . '" fue creado';
    }

    if ($eventName == 'updated')
    {
      return 'Recurso "' . $this->name . '" fue actualizado';
    }

    if ($eventName == 'deleted')
    {
      return 'Recurso "' . $this->name . '" fue eliminado';
    }

    return '';
  }
}
