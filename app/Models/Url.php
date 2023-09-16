<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Ripple;

class Url extends Model
{
    use HasFactory;
    protected $table = 'urls';
    protected $primaryKey = 'encrypted_url';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
      'rippler_id',
      'url',
      'encrypted_url',
      ];
      
    //define an eloquent relationship...between a url and the immediate nest level 0 ripples
    public function getRipplesAssociatedToPost() {
      return $this->hasMany(Ripple::class,'encrypted_url','encrypted_url')->where('isQuote','=',0)->where('ripple_nest_level','=',0)->simplePaginate(1);
    }
}
