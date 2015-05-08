<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Directors extends Model {

	protected $table = 'directors';

	protected $fillable = ['identification', 'first_name', 'last_name', 'prefix_phone', 'number_phone', 'email', 'resolution'];

}
