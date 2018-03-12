<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserListingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the modelsListing.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Listing  $listing
     * @return mixed
     */
    public function access(User $user, Listing $listing)
    {
        //
        return $user->id === $listing->user_id;
    }

    public function notCreate(User $user)
    {
        return $user->user_type !== 'host';
    }

    
}
