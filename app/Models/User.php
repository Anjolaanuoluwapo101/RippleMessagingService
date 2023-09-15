<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
  use HasApiTokens,
  HasFactory,
  Notifiable;
  protected $primaryKey = 'rippler_id';
  public $incrementing = false; // Disable auto-incrementing
  protected $keyType = 'string'; // Define the key type as string (UUID)
  /**
  * The attributes that are mass assignable.
  *
  * @var array<int, string>
  */
  protected $fillable = [
    'rippler_id',
    'name',
    'email',
    'password',
    'email_verified_at',
  ];

  /**
  * The attributes that should be hidden for serialization.
  *
  * @var array<int, string>
  */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
  * The attributes that should be cast.
  *
  * @var array<string, string>
  */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  //ensures that a uuid is generated ..not usually needed but laravel is acting up
  protected static function booted() {
    static::creating(function ($model) {
      if (!$model->id) {
        $model->rippler_id = (string) Str::uuid();
      }
    });
  }
}