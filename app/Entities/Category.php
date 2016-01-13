<?php
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Category extends Model implements LogsActivityInterface
{
  use LogsActivity;

  protected $table = 'categories';

  protected $fillable = ['name'];

  protected $hidden = ['created_at', 'updated_at'];

  public function themes()
  {
    return $this->hasMany(Theme::class);
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
      return 'Categoría "' . $this->name . '" fue creado';
    }

    if ($eventName == 'updated') {
      return 'Categoría "' . $this->name . '" fue actualizado';
    }

    if ($eventName == 'deleted') {
      return 'Categoría "' . $this->name . '" fue eliminado';
    }

    return '';
  }
}
