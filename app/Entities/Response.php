<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Response extends Model {

	protected $table = 'responses';

	protected $fillable = ['instrument_id', 'number_job', 'observation'];

}
