<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Instrument extends Model {

	protected $table = 'instruments';

	protected $fillable = ['date', 'area_request_id', 'observation'];

}
