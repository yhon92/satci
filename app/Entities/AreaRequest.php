<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class AreaRequest extends Model {

	protected $table = 'area_requests';

	protected $fillable = ['theme_request_id', 'area_id'];

}
