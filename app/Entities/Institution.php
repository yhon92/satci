<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model {

	protected $table = 'institutions';

	protected $fillable = ['rif',
												'name',
												'address',
												'prefix_phone',
												'number_phone',
												'agent_first_name',
												'agent_last_name',
												'agent_identification',
												'parish_id'];

}
