<?php 
namespace SATCI\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Johnnymn\Sim\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Johnnymn\Sim\Roles\Traits\HasRoleAndPermission;
use Spatie\Activitylog\LogsActivity;
use Spatie\Activitylog\LogsActivityInterface;

class User extends Model implements 
  AuthenticatableContract, 
  CanResetPasswordContract, 
  HasRoleAndPermissionContract, 
  LogsActivityInterface
{
  use Authenticatable; 
  use CanResetPassword;
  use HasRoleAndPermission;
  use LogsActivity;

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

  public function roles()
  {
    return $this->belongsToMany(config('roles.models.role'));
  }

  public function permissions()
  {
    return $this->belongsToMany(config('roles.models.permission'));
  }

  public function setPasswordAttribute($value)
  {
    if (!empty($value)) {
      $this->attributes['password'] = bcrypt($value);
    }
  }

  public function getFullNameAttribute()
  {
    return $this->first_name.' '.$this->last_name;
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

  /**
  * Get the message that needs to be logged for the given event name.
  *
  * @param string $eventName
  * @return string
  */
  public function getActivityDescriptionForEvent($eventName)
  {
    if ($eventName == 'created') {
      return 'Usuario "' . $this->first_name . ' ' . $this->last_name . '" fue creado';
    }

    if ($eventName == 'updated') {
      return 'Usuario "' . $this->first_name . ' ' . $this->last_name . '" fue actualizado';
    }

    if ($eventName == 'deleted') {
      return 'Usuario "' . $this->first_name . ' ' . $this->last_name . '" fue eliminado';
    }

    return '';
  }
  
}
