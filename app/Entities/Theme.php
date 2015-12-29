<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{

  protected $table = 'themes';

  protected $fillable = ['name', 'category_id'];

  protected $hidden = ['created_at', 'updated_at'];

  public function category()
  {
    return $this->belongsTo('SATCI\Entities\Category');
  }

  public function assign_solicitude()
  {
    return $this->hasMany(AssignSolicitude::class);
  }
  
}
