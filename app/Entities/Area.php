<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Area extends Model {

  protected $table = 'areas';

  protected $fillable = ['name', ];
  
  protected $hidden = ['director_id', 'pivot', 'created_at', 'updated_at'];

  public function director()
  {
    return $this->belongsTo('SATCI\Entities\Director');
  }

  public function means()
  {
    return $this->belongsToMany('SATCI\Entities\Means');
  }
}
