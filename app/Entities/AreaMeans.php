<?php
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class AreaMeans extends Model
{
  protected $table = 'area_means';
  
  // protected $fillable = ['id'];
  
  // protected $hidden = ['created_at', 'updated_at'];

  public function area()
  {
    return $this->hasMany('SATCI\Entities\Area');
  }

  public function means()
  {
    return $this->hayMany('SATCI\Entities\Means');
  }

  public function solicitude()
  {
    return $this->hasMany('SATCI\Entities\AssignSolicitude');
  }
}
