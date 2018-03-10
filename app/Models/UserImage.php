<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    //

    function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
