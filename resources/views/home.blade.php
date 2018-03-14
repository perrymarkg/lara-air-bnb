@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach( $properties as $property )
            <div class="col-md-3">
                
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title"> {{ $property->title }} </h5>
                    <p class="card-text"> {{ $property->description }} </p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                </div>
            
            </div>
            
        @endforeach
    </div>
</div>
@endsection
