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
  
}
