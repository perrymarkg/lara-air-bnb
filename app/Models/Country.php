<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    public $timestamps = false;

    public function listings(){
        return $this->hasMany('App\Model\Listing');
    }

}
