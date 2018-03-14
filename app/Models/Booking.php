<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    public function listing()
    {
        return $this->belongsTo('App\Models\Listing');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
