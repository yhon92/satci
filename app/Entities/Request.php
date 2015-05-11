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

/*	public function citizen()
	{
		$type = $this->attributes['identification_type'];

		if ($type == 'Natural') 
		{
			return $this->hasMany('SATCI\Entities\Citizen');
		}

	}

	public function institution()
	{
		$type = $this->attributes['identification_type'];

		if ($type == 'Jurídica') 
		{
			return $this->hasMany('SATCI\Entities\Institution');
		}

	}*/

	public function applicant($value='')
	{
		$type = $this->attributes['identification_type'];

		if ($type == 'Natural') 
		{
			// dd('Hola: ' . $type);
			return $this->hasOne('SATCI\Entities\Citizen', 'id', 'applicant_id');
		}
		if ($type == 'Jurídica') 
		{
			// dd('Hola: ' . $type);
			return $this->hasOne('SATCI\Entities\Institution', 'id', 'applicant_id');
		}
	}

}
