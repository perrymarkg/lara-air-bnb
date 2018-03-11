@extends('profile.base')

@section('content')
<h1>{{ __('Edit Details') }}</h1>
<hr>

<?php
    $fields = [
        'Firstname' => 'first_name',
        'Lastname' => 'last_name',
        'Address' => 'address',
        'Phone' => 'phone',
    ];
?>

@component('ui.error-component')
@endcomponent

@if (session('status'))
    @component('ui.success-component')
    {{ session('status') }}
    @endcomponent
@endif

<form action="" method="post">
    {{ csrf_field() }}
    @foreach($fields as $key => $val)
    <div class="form-group row">
        <label for="{{ $val }}" class="col-sm-2">{{ $key }}</label>
        <div class="col-sm-10">
            <input 
                type="text" 
                class="form-control" 
                name="{{ $val }}" 
                id="{{ $val }}"
                value="{{ old($val) ? old($val) : Auth::user()->$val }}"
                />
        </div>
    </div>
    @endforeach
    <div class="form-group text-right">
        <button class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</form>
@endsection