<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model {

	protected $table = 'parishes';

	protected $fillable = ['name'];

  protected $hidden = ['created_at', 'updated_at'];

}
