<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Request extends Model {

	protected $table = 'requests';

	protected $fillable = ['request_number', 
													'reception_date', 
													'identification_type', 
													'applicant_id', 
													'document_date', 
													'topic', 
													'status'];

}
