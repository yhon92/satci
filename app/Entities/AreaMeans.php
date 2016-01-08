<?php
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class AreaMeans extends Model implements LogsActivityInterface
{
  use LogsActivity;

  protected $table = 'area_means';
  
  // protected $fillable = ['id'];
  
  // protected $hidden = ['created_at', 'updated_at'];
  protected $hidden = ['area_id', 'means_id'];

  public function area()
  {
    return $this->belongsTo(Area::class);
  }

  public function means()
  {
    return $this->belongsTo(Means::class);
  }

  public function solicitude()
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
    if ($eventName == 'created')
    {
      return 'Asignacion de Recurso a Area "' . $this->area_id . ' -> ' . $this->means_id . '" fue creado';
    }

    if ($eventName == 'updated')
    {
      return 'Asignacion de Recurso a Area "' . $this->area_id . ' -> ' . $this->means_id . '" fue actualizado';
    }

    if ($eventName == 'deleted')
    {
      return 'Asignacion de Recurso a Area "' . $this->area_id . ' -> ' . $this->means_id . '" fue eliminado';
    }

    return '';
  }
  
}
