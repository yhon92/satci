<?php
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class AreaMeans extends Model
{

  protected $table = 'area_means';
  
  // protected $fillable = ['id'];
  
  // protected $hidden = ['created_at', 'updated_at'];
  protected $hidden = ['area_id', 'means_id'];

  public function area()
  {
    return $this->belongsTo('SATCI\Entities\Area');
  }

  public function means()
  {
    return $this->belongsTo('SATCI\Entities\Means');
  }

  public function solicitude()
  {
    return $this->hasMany('SATCI\Entities\AssignSolicitude');
  }
  
}
