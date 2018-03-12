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

@if (session('status'))
    @component('ui.success-component')
    {{ session('status') }}
    @endcomponent
@endif

@component('profile.forms.listing', ['listing' => $listing, 'submit_url' => $submit_url, 'mode' => $mode])
@endcomponent


@endsection