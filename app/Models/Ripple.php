<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\LazyCollection;
use App\Models\User;

class Ripple extends Model
{
  use HasFactory;
  use HasUuids; //identify the UUID id column as tr primary key
  protected $table = 'ripples';
  protected $primaryKey = 'ripple_id';
  public $incrementing = false;
  //protected $keyType = 'string';

  protected $fillable = [
    'ripple_reference_id',
    'rippler_reference_id',
    'ripple_body',
    'rippler_id',
    'ripplers_tagged',
    'ripple_attachments',
    'ripple_nest_level',
    'encrypted_url',
  ];

  //convert some attribute's data type
  protected $casts = [
    //'rippler_attachments' => 'array',
    //'ripplers_tagged' => 'array',
  ];

  //define some default values for the following attributes
  protected $attributes = [

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
  public $imageMimeTypes = [
    "jpeg",
    "jpg",
    "png",
    "webp",
  ];

  //relationship that gets non quote related ripples.. basically replies to a post
  public function relatedNonQuotedRipples() {
    return $this->hasMany(Ripple::class, 'ripple_reference_id', 'ripple_id')->where('encrypted_url', '=', request()->route('encrypted_url'))->where('isQuote', '!=', 1)
    ->simplePaginate(1);

  }

  public static function searchForRelatedRipples(array $keywords) {
    // Create a cursor loaded query for the initial query
    $lazyRipples = Ripple::where(function ($query) use ($keywords) {
      foreach ($keywords as $value) {
        $query->orWhere('ripple_body', 'like', "%$value%")
        ->orWhere('rippler_name', 'like', "%$value%");
      }
    })
    ->orderBy('created_at', 'desc')
    ->simplePaginate(1);

    $lazyRipplesData = $lazyRipples->items();
    $result = [];

    // Iterate through the lazy collection and load each item
    foreach ($lazyRipplesData as $ripple) {
      //check if the ripple is a quote
      if ($ripple->isQuote == 1) {
        //fetch some extra details
        $ripplerThatMadeTheRippleDetails = User::select('name', 'email')->where('rippler_id', '=', $ripple->rippler_id)->first();
        $ripple = array_merge($ripplerThatMadeTheRippleDetails->toArray(), $ripple->toArray());
        // Fetch the quoted records based on ripple_reference_id
        $quotedRipple = Ripple::where('ripple_id', $ripple['ripple_reference_id'])->first();

        // Add both the quoted record and the initial record to the result
        if ($quotedRipple) {
          $result['data'][] = [
            "ripple" => $ripple,
            "quotedRipple" => $quotedRipple
          ];
        }
      } else {
        //fetch som extra details
        $ripplerThatMadeTheRippleDetails = User::select('name', 'email')->where('rippler_id', '=', $ripple->rippler_id)->first();
        $ripple = array_merge($ripplerThatMadeTheRippleDetails->toArray(), $ripple->toArray());
        $result['data'][] = [
          "ripple" => $ripple,
          "quotedRipple" => null
        ];
      }
    }

    //add the next_page_url and prev_page_url
    $result["links"] = [
      "prev_page_url" => $lazyRipples->previousPageUrl(),
      "next_page_url" => $lazyRipples->nextPageUrl()
    ];
    // Now, $result contains the filtered and ordered ripple records
    return $result;
  }
}