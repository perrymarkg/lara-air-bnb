<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Property;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPropertiesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the modelsListing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Property  $property
     * @return mixed
     */
    public function access(User $user, Property $property)
    {
        //
        return $user->id === $property->user_id;
    }

    public function notCreate(User $user)
    {
        return $user->user_type !== 'host';
    }

    
}
