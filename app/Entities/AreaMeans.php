<?php
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class AreaMeans extends Model
{
  protected $table = 'area_means';
  
  // protected $fillable = ['id'];
  
  // protected $hidden = ['created_at', 'updated_at'];

  public function areas()
  {
    return $this->belongsToMany('SATCI\Entities\Area');
  }
}
