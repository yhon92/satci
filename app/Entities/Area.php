<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

  protected $table = 'areas';

  protected $fillable = ['name', 'email', 'director_id'];
  
  protected $hidden = ['director_id', 'pivot', 'created_at', 'updated_at'];

  public function director()
  {
    return $this->belongsTo(Director::class);
  }

  public function means()
  {
    return $this->belongsToMany(Means::class);
  }
  
}
