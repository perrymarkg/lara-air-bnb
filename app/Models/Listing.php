<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'title', 'address', 'phone',
        'price', 'type', 'max_kids', 'max_adults',
        'bedrooms', 'beds', 'baths', 'description',
        'rules', 'cancellation'
    ];
    //
    function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    function images()
    {
        return $this->hasMany('App\Models\ListingImage', 'listing_id');
    }

    function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }
}
