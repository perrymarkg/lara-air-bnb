<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    //
    function user(){
        return $this->belongsTo('App\Models\User');
    }

    function country(){
        return $this->belongsTo('App\Models\Country');
    }

    function images(){
        return $this->hasMany('App\Models\ListingImage', 'listing_id');
    }
}
