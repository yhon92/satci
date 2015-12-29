<?php
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

  protected $table = 'categories';

  protected $fillable = ['name'];

  protected $hidden = ['created_at', 'updated_at'];

  public function themes()
  {
    return $this->hasMany(Theme::class);
  }
  
}
