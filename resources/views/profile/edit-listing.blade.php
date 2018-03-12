@extends('profile.base')

@section('content')
<h2>
    @if( $mode === 'create')
        {{ __('New Listing') }}
    @else 
        {{ __('Edit Listing') }}
    @endif
</h2>
<hr>

@component('ui.error-component')
@endcomponent

@component('ui.success-component')
@endcomponent

@component('profile.forms.listing', ['listing' => $listing, 'submit_url' => $submit_url, 'mode' => $mode])
@endcomponent


@endsection