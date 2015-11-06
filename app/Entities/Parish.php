<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model {

	protected $table = 'parishes';

	protected $fillable = ['name'];

  protected $hidden = ['created_at', 'updated_at'];
  
  public function citizens()
  {
    return $this->hasMany('SATCI\Entities\Citizen');
  }

  public function institutions()
  {
    return $this->hasMany('SATCI\Entities\Institution');
  }

}
