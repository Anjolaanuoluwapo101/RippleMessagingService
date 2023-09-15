<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use App\Models\RipplerInformation;

class RippleResource extends JsonResource
{
  /**
  * Transform the resource into an array.
  *
  * @return array<string, mixed>
  */
  public static $wrap = 'rippleData';
  
  public function toArray(Request $request): array
  {
    return [
      'rippler_name' => RipplerInformation::find($this->rippler_id)->first()->rippler_name,
      // Other ripple attributes...
      //we pass a relatedRipples() as a function instead of as a member variable...this is to because we want paginateFilteredRelatedRipples function to 
      //recieve a query result and not a collection...paginateFilteredRelatedRipples function using cursorPaginate which isnt a collection method
      //'related_ripples' => $this->paginateFilteredRelatedRipples($this->relatedRipples()),
      //found another easier way...just paginate the relationship itself in the Ripple model
      'related_ripples' => $this->relatedNonQuotedRipples(),
    ];
  }
  
  //Not in use
  //a less efficient way of getting related records
  protected function lazyLoadRelatedRipples($relatedRipples) {
    // Use lazy loading for related records
    $lazyCollection = $relatedRipples->cursor();
    // Convert the lazy collection to a regular Collection if needed
    return Collection::make($lazyCollection);
  }
  
  
  //Not in use
  //by using cursorPaginate,we reduce the intensive querying on the db because we restrict the result being fetch to a certain number
  protected function paginateFilteredRelatedRipples($relatedRipples) {
    // Specify the number of records per page
    $perPage = 1; // Adjust this to your desired number
    // Use cursorPaginate for pagination
    $paginator = $relatedRipples->cursorPaginate($perPage);
    // Convert the paginator to an array
    return [
      'data' => Collection::make($paginator->items()),
      'links' => [
        'prev' => $paginator->previousPageUrl(),
        'next' => $paginator->nextPageUrl(),
      ],
    ];
  }
}
