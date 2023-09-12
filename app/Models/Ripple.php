<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ripple extends Model
{
  use HasFactory;
  use HasUuids; //identify the UUID id column as tr primary key
  protected $table = 'ripples';
  
    protected $fillable = [
      'ripple_reference_id',
      'ripple_body',
      'rippler_id', 
      'rippler_email', 
      'ripple_attachments',
      ];
      
  //convert some attribute's data type
  protected $casts = [
    'rippler_attachments' => 'array',
    'ripplers_tagged' => 'array',
  ];

  //define some default values for the following attributes
  protected $attributes = [
    'ripple_likes_count' => 0,
    'ripple_ripples_count' => 0,
    'ripple_nest_level' => 0,
    'rippler_name' => "",
    'rippler_reference_id' => 0,
    'ripple_reference_id' => 0,
  ];

  //supported mime types
  public $videoMimeTypes = [
    "mp4",
    "3gp",
    "mkv",
    ];
  public $audioMimeTypes = [
    "ogg",
    "wav",
    "mp3",
    ];
  public $imageMimeTypes= [
    "jpeg",
    "jpg",
    "png",
    "webp",
    ];
   

  /*
  protected function ripplersTagged(): Attribute
  {
    return Attribute::make(
      get: fn (string $value) => $value,
    );
  }*/

}