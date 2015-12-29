<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
  
  protected $table = 'directors';

  protected $fillable = ['identification', 
                          'full_name', 
                          'first_name', 
                          'last_name', 
                          'prefix_phone', 
                          'number_phone', 
                          'email', 
                          'resolution'];

  protected $hidden = ['pivot', 'created_at', 'updated_at'];

  public function areas()
  {
    return $this->hasMay(Area::class);
  }

}
