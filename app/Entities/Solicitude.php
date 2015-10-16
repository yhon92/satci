<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Solicitude extends Model {

	protected $table = 'solicitudes';

	protected $fillable = ['solicitude_number', 
													'reception_date', 
													'applicant_type', 
													'applicant_id', 
													'document_date', 
													'topic', 
													'status'];

	// protected $hidden = ['applicant_id', 'applicant_type'];
	
	public function applicant()
	{
		return $this->morphTo();
	}

}
