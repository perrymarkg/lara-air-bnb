<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
    public $timestamps = false;

    //
    public function listings(){
        return $this->belongsTo('App\Models\Listing');
    }
}
