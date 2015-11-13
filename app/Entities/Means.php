<?php
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Means extends Model
{
  protected $table = 'means';
  
  protected $fillable = ['name'];
  
  protected $hidden = [/*'pivot',*/ 'created_at', 'updated_at'];

  public function areas()
  {
    return $this->belongsToMany('SATCI\Entities\Area');
  }
}
