<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Director extends Model implements LogsActivityInterface
{
  use LogsActivity;
  
  protected $table = 'directors';

  protected $fillable = ['identification', 
                          'full_name', 
                          'first_name', 
                          'last_name', 
                          'prefix_phone', 
                          'number_phone', 
                          'email', 
                          'resolution'];

  // protected $hidden = ['created_at', 'updated_at'];

  public function areas()
  {
    return $this->hasMany(Area::class);
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
      return 'Director "' . $this->full_name . '" fue creado';
    }

    if ($eventName == 'updated')
    {
      return 'Director "' . $this->full_name . '" fue actualizado';
    }

    if ($eventName == 'deleted')
    {
      return 'Director "' . $this->full_name . '" fue eliminado';
    }

    return '';
  }
}
