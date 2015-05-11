<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class ThemeRequest extends Model {

	protected $table = 'theme_requests';

	protected $fillable = ['request_id', 'theme_id'];

}
