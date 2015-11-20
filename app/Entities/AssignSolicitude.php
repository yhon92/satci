<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class AssignSolicitude extends Model {

	protected $table = 'assign_solicitudes';

  protected $fillable = ['id', 'solicitude_id', 'theme_id', 'area_means_id'];

	// protected $primaryKey = ['solicitude_id', 'theme_id', 'area_means_id'];

}
