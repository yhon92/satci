<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{

  protected $table = 'parishes';

  protected $fillable = ['id', 'name'];

  protected $hidden = ['created_at', 'updated_at'];
  
  public function citizens()
  {
    return $this->hasMany(Citizen::class);
  }

  public function institutions()
  {
    return $this->hasMany(Institution::class);
  }
  
}
