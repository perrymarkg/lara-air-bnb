<?php

if( $type === 'dropdown' ){
    $class = 'dropdown-item';
}
elseif ( $type === 'sidebar') {
    $class = 'list-group-item';
}

// define active
$profile = ['profile.index', 'profile.details.edit', 'profile.account.edit'];
$properties = ['profile.properties.index', 'profile.properties.edit', 'profile.properties.create'];
?>
<a href="{{ route('profile.index')}}" 
    class="{{ $class }} {{ Helper::isActiveRoute( $profile ) }}">
    {{ __('Profile') }}
</a>
@if( Auth::user()->user_type === 'host' )
    <a href="{{ route('profile.properties.index') }}" 
    class="{{ $class }} {{ Helper::isActiveRoute( $properties ) }}">
        {{ __('Properties') }}
    </a>
    <a href="{{--  {{ route('profile.properties.index') }}  --}}" 
    class="{{ $class }} {{ Helper::isActiveRoute( [] ) }}">
        {{ __('Property Bookings') }}
    </a>
@endif
<a href="{{--  {{ route('profile.properties.index') }}  --}}" 
    class="{{ $class }} {{ Helper::isActiveRoute( [] ) }}">
        {{ __('Bookings') }}
    </a>
<a class="{{ $class }}" href="{{ route('logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    {{ __('Logout') }}
</a>