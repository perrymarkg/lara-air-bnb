<?php

if( $type === 'dropdown' ){
    $class = 'dropdown-item';
}
elseif ( $type === 'sidebar') {
    $class = 'list-group-item';
}

// define active
$profile = ['profile.index', 'profile.details.edit', 'profile.account.edit'];
$listings = ['profile.listings.index', 'profile.listings.edit', 'profile.listings.create'];
?>
<a href="{{ route('profile.index')}}" 
    class="{{ $class }} {{ Helper::isActiveRoute( $profile ) }}">
    {{ __('Profile') }}
</a>
@if( Auth::user()->user_type === 'host' )
    <a href="{{ route('profile.listings.index') }}" 
    class="{{ $class }} {{ Helper::isActiveRoute( $listings ) }}">
        {{ __('Listings') }}
    </a>
    <a href="{{--  {{ route('profile.listings.index') }}  --}}" 
    class="{{ $class }} {{ Helper::isActiveRoute( [] ) }}">
        {{ __('Listing Bookings') }}
    </a>
@endif
<a href="{{--  {{ route('profile.listings.index') }}  --}}" 
    class="{{ $class }} {{ Helper::isActiveRoute( [] ) }}">
        {{ __('Bookings') }}
    </a>
<a class="{{ $class }}" href="{{ route('logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    {{ __('Logout') }}
</a>