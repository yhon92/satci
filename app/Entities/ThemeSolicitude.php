<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class ThemeSolicitude extends Model {

	protected $table = 'theme_solicitudes';

	protected $fillable = ['request_id', 'theme_id'];

}
