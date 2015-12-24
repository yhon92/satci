<?php 
namespace SATCI\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

  use Authenticatable, CanResetPassword;

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['first_name', 'last_name', 'username', 'password', 'active'];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = ['password', 'remember_token'];

  public function getFullNameAttribute()
  {
    return $this->first_name.' '.$this->last_name;
  }

  public function setPasswordAttribute($value)
  {
    if (!empty($value)) {
      $this->attributes['password'] = bcrypt($value);
    }
  }

  public function setActiveAttribute($value)
  {
    if ($value) {
      $this->attributes['active'] = true;
    } else {
      $this->attributes['active'] = false;
    }
  }

  public function getStatusAttribute()
  {
    if ($this->active) {
      return 'Activo';
    } else {
      return 'Inactivo';
    }
  }
  
}
