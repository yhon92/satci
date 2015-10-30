<?php namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model {

	protected $table = 'themes';

	protected $fillable = ['name'];

  protected $hidden = ['created_at', 'updated_at'];

}
