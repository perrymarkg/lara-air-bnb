<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable = ['user_id', 'property_id', 'status', 'check_in', 'check_out', 'details'];
    
    public function listing()
    {
        return $this->belongsTo('App\Models\Listing');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
