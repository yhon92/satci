<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivity;
use Spatie\Activitylog\LogsActivityInterface;

class AssignSolicitude extends Model implements LogsActivityInterface
{
  use LogsActivity;
  
  protected $table = 'assign_solicitudes';

  protected $fillable = ['id', 'solicitude_id', 'theme_id', 'area_means_id', 'status'];

  protected $hidden = ['solicitude_id', 'theme_id', 'area_means_id'];

  public function observation()
  {
    return $this->hasOne(AssignObservation::class);
  }
  
  public function theme()
  {
    return $this->belongsTo(Theme::class);
  }

  public function area_means()
  {
    return $this->belongsTo(AreaMeans::class);
  }

  public function getActivityDescriptionForEvent($eventName)
  {
    if ($eventName == 'created') {
      return 'Asignación de Solicitud "' . $this->id . '" fue creado';
    }

    if ($eventName == 'updated') {
      return 'Asignación de Solicitud "' . $this->id . '" fue actualizado al Estado: "' . $this->status . '"';
    }

    if ($eventName == 'deleted') {
      return 'Asignación de Solicitud "' . $this->id . '" fue eliminado';
    }

    return '';
  }

}
