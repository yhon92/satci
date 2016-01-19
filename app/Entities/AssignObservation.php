<?php
namespace SATCI\Entities;

use Illuminate\Database\Eloquent\Model;

class AssignObservation extends Model
{
  protected $table = 'assign_observations';

  protected $fillable = ['id', 'assign_solicitude_id', 'status', 'body'];

  public function assigned()
  {
    return $this->belongsTo(AssignSolicitude::class);
  }
}
