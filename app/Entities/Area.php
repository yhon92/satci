<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Area extends Model implements LogsActivityInterface
{
  use LogsActivity;

  protected $table = 'areas';

  protected $fillable = ['name', 'email', 'director_id'];
  
  protected $hidden = ['director_id', 'pivot', 'created_at', 'updated_at'];

  public function director()
  {
    return $this->belongsTo(Director::class);
  }

  public function means()
  {
    return $this->belongsToMany(Means::class);
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
      return 'Area "' . $this->name . '" fue creado';
    }

    if ($eventName == 'updated')
    {
      return 'Area "' . $this->name . '" fue actualizado';
    }

    if ($eventName == 'deleted')
    {
      return 'Area "' . $this->name . '" fue eliminado';
    }

    return '';
  }
  
}
