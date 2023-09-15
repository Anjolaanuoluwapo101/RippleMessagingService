<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\LazyCollection;

class Ripple extends Model
{
  use HasFactory;
  use HasUuids; //identify the UUID id column as tr primary key
  protected $table = 'ripples';
  protected $primaryKey = 'ripple_id';
  
  protected $fillable = [
    'ripple_reference_id',
    'ripple_body',
    'rippler_id',
    'rippler_email',
    'ripple_attachments',
  ];

  //convert some attribute's data type
  protected $casts = [
    //'rippler_attachments' => 'array',
    //'ripplers_tagged' => 'array',
  ];

  //define some default values for the following attributes
  protected $attributes = [
    'ripple_likes_count' => 0,
    'ripple_ripples_count' => 0,
    'ripple_nest_level' => 0,
    'rippler_name' => '',
    'rippler_email' => '',
    'ripple_body' => '',
    'rippler_reference_id' => null,
    'ripple_reference_id' => null,
    'ripple_attachments' => 'a:0:{}',
    'ripplers_tagged' => 'a:0:{}',
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
  
  protected static function pageSorter(){
    $perPage = 1; // Number of records per page
    $currentPage = request()->input('page', 1); // Get the current page from the request
    // Calculate the offset based on the current page
    $offset = ($currentPage - 1) * $perPage;
    return [
      'offset' => $offset,
      'perPage' => $perPage
      ];
  }
  //establish a eloquent relationship within the same table between the ripple_reference_id and ripple_id column

  //relationship that gets non quote related ripples.. basically replies to a post
  public function relatedNonQuotedRipples() {
    return $this->hasMany(Ripple::class, 'ripple_reference_id', 'ripple_id')->where('isQuote', '!=', 1)
      ->cursor()
      ->skip(Ripple::pageSorter()['offset'])
      ->take(Ripple::pageSorter()['perPage']);
  }

  public static function searchForRelatedRipples(array $keywords) {
    $perPage = 1; // Number of records per page
    $currentPage = request()->input('page', 1); // Get the current page from the request
    // Calculate the offset based on the current page
    $offset = ($currentPage - 1) * $perPage;
    // Create a cursor loaded query for the initial query
    $lazyRipples=  Ripple::where(function ($query) use ($keywords) {
        foreach ($keywords as $value) {
          $query->orWhere('ripple_body', 'like', "%$value%")
          ->orWhere('rippler_name', 'like', "%$value%");
        }
      })
      ->orderBy('created_at', 'desc')
      ->cursor()
      ->skip(Ripple::pageSorter()['offset'])
      ->take(Ripple::pageSorter()['perPage']);
    // Initialize the result as an empty array
    $result = [];

    // Iterate through the lazy collection and load each item
    $lazyRipples->each(function ($ripple) use (&$result) {
      if ($ripple->isQuote == 1) {
        // Fetch the quoted records based on ripple_reference_id
        $quotedRipple = Ripple::where('ripple_id', $ripple->ripple_reference_id)->first();

        // Add both the quoted record and the initial record to the result
        if ($quotedRipple) {
          $result[] = [
            "ripple" => $ripple,
            "quotedRipple" => $quotedRipple
          ];
        }
        //$result[] = $ripple;
      } else {
        $result[] = [
          "ripple" => $ripple,
          "quotedRipple" => null
        ];
      }
    });
    //add the next_page_url and prev_page_url 
    /*$result["links"] = [
      "prev_page_url" => $paginator->prevPageUrl(),
      "next_page_url" => $paginator->nextPageUrl()
      ];*/
    // Now, $result contains the filtered and ordered ripple records
    return $result;
  }

  //relationship that gets quoted


}