<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model {

	protected $table = 'institutions';

	protected $fillable = ['identification',
													'full_name',
													'address',
													'prefix_phone',
													'number_phone',
													'agent_identification',
													'agent_full_name',
													'agent_first_name',
													'agent_last_name',
													'parish_id'];

}
