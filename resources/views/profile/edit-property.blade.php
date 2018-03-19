@extends('profile._base')

@section('content')
<h2>
    @if( $mode === 'create')
        {{ __('New Property') }}
    @else 
        {{ __('Edit Property') }}
    @endif
</h2>
<hr>

@component('components.ui.error')
@endcomponent

@component('components.ui.success')
@endcomponent

@component('profile.forms.property', ['property' => $property, 'submit_url' => $submit_url, 'mode' => $mode])
@endcomponent


@endsection