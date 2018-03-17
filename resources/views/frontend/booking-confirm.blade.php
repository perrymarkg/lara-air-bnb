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
                
                <form class="card-body">
                    {{ csrf_field() }}
                    <h4> {{ $property->title }} </h4>
                    
                    {!! $results_html !!}
                    <input type="hidden" name="property_id" value=" {{ $property->id }} ">
                    <input type="hidden" name="check_in" value=" {{$request->check_in}} ">
                    <input type="hidden" name="check_out" value=" {{$request->check_out}} ">
                    <button class="btn btn-primary btn-block mt-3">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection