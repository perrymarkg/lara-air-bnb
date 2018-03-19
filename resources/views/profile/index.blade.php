@extends('profile._base')

<?php
  $profile = [
    'Firstname' => 'first_name',
    'Lastname' => 'last_name',
    'Phone' => 'phone',
    'Address' => 'address'
  ];

  $account = [
    'Username' => 'username',
    'Email' => 'email'
  ];
?>

@section('content')
<h1>{{ __('My Profile') }}</h1>
<hr>
<h2>{{ __('Details') }}</h2>
<ul class="list-group mb-3">
  
  @foreach( $profile as $key => $val)
  <li class="list-group-item">
    <strong>{{ __($key) }}: </strong> {{ Auth::user()->$val }}
  </li>
  @endforeach
  
</ul>
<div class="mb-3 text-right">
  <a href="{{ route('profile.details.edit') }}" class="btn btn-secondary">{{ __('Edit') }}</a>
</div>
<hr>
<h2>{{ __('Account') }}</h2>
<ul class="list-group mb-3">
  
    @foreach( $account as $key => $val)
    <li class="list-group-item">
      <strong>{{ __($key) }}: </strong> {{ Auth::user()->$val }}
    </li>
    @endforeach
    
  </ul>
<div class="mb-3 text-right">
    <a href="{{ route('profile.account.edit') }}" class="btn btn-secondary">{{ __('Edit') }}</a>
</div>
@endsection