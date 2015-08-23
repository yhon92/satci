<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model {

	protected $table = 'citizens';

	protected $fillable = ['identification', 
													'full_name', 
													'first_name', 
													'last_name', 
													'address', 
													'prefix_phone', 
													'number_phone', 
													'parish_id'];

  public function solicitudes()
  {
    return $this->morphMany('SATCI\Entities\Solicitude', 'applicant');
  }
}