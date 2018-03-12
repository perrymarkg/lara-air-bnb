<?php
    // define active
    $profile = ['profile.index', 'profile.details.edit', 'profile.account.edit'];
    $listings = ['profile.listings.index', 'profile.listings.edit', 'profile.listings.create'];
?>
<div class="list-group">
    <a href="{{ route('profile.index')}}" 
    class="list-group-item list-group-item-action {{ Helper::isActiveRoute( $profile ) }}">
        {{ __('My Profile') }}
    </a>
    @if( Auth::user()->user_type === 'host' )
        <a href="{{ route('profile.listings.index') }}" 
        class="list-group-item list-group-item-action {{ Helper::isActiveRoute( $listings ) }}">
            {{ __('My Listings') }}
        </a>
    @endif
    <a href="#" class="list-group-item list-group-item-action">
        {{ __('Logout') }}
    </a>
    
</div>