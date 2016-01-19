<?php
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class AssignComment extends Model
{
  protected $table = 'assign_comments';

  protected $fillable = ['id', 'assign_solicitude_id', 'status', 'observation'];

  public function assigned()
  {
    return $this->hasMay(AssignSolicitude::class);
  }
}
