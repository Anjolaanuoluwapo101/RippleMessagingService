<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class RipplerInformation extends Authenticatable
{
    use HasFactory;
    protected $table = 'rippler_information';
    protected $primaryKey = 'rippler_id';
    
    protected $fillable = [
      'rippler_name',
      'password',
      'rippler_email',
      'rippler_id',
      ];
}
