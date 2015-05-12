<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class AreaSolicitude extends Model {

	protected $table = 'area_solicitudes';

	protected $fillable = ['theme_solicitude_id', 'area_id'];

}
