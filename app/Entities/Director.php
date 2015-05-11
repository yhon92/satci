<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Director extends Model {

	protected $table = 'directors';

	protected $fillable = ['identification', 
													'full_name', 
													'first_name', 
													'last_name', 
													'prefix_phone', 
													'number_phone', 
													'email', 
													'resolution'];

}
