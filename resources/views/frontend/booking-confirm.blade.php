@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Confirm your booking</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            @if( $price_changed )
                @component('components.ui.notice', 
                ['content' => 'Price has been updated please review your booking details'])
                @endcomponent
            @endif
            <div class="card">
                
                <form action="{{ route('booking.process') }}" class="card-body" method="POST">
                    {{ csrf_field() }}
                    <h4> {{ $property->title }} </h4>
                    
                    {!! $results_html !!}
                    <input type="hidden" name="data" value="{{ $json_data }}"/>
                    <button class="btn btn-primary btn-block mt-3">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection