<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email', 
        'password',
        'first_name',
        'last_name',
        'phone',
        'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    function properties()
    {
        return $this->hasMany('App\Models\Property');
    }

    function images()
    {
        return $this->hasMany('App\Models\UserImage');
    }

    function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }
}
