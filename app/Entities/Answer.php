<?php 
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

	protected $table = 'answers';

	protected $fillable = ['instrument_id', 'number_job', 'observation'];

}
