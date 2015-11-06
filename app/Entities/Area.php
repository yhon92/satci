<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Area extends Model {

	protected $table = 'areas';

	protected $fillable = ['name', 'director_id'];

}
