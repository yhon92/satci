<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class AssignSolicitude extends Model {

	protected $table = 'assign_solicitudes';

  protected $fillable = ['id', 'solicitude_id', 'theme_id', 'area_means_id', 'status'];

	protected $hidden = ['solicitude_id', 'theme_id', 'area_means_id'];

  public function theme()
  {
    return $this->belongsTo('SATCI\Entities\Theme');
  }

  public function area_means()
  {
    return $this->belongsTo('SATCI\Entities\AreaMeans');
  }

}
