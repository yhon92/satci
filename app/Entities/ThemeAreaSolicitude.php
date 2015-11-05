<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class ThemeAreaSolicitude extends Model {

	protected $table = 'theme_area_solicitudes';

	protected $fillable = ['solicitude_id', 'theme_id', 'area_id'];

}
