<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Theme extends Model implements LogsActivityInterface
{
  use LogsActivity;

  protected $table = 'themes';

  protected $fillable = ['name', 'category_id'];

  protected $hidden = ['created_at', 'updated_at'];

  public function category()
  {
    return $this->belongsTo('SATCI\Entities\Category');
  }

  public function assign_solicitude()
  {
    return $this->hasMany(AssignSolicitude::class);
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
      return 'Tema "' . $this->name . '" fue creado';
    }

    if ($eventName == 'updated') {
      return 'Tema "' . $this->name . '" fue actualizado';
    }

    if ($eventName == 'deleted') {
      return 'Tema "' . $this->name . '" fue eliminado';
    }

    return '';
  }
  
}
