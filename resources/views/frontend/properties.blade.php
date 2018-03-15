@extends('frontend.base')

@section('content')
<div class="row">
    @if($properties)
    @foreach($properties as $property)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header"> {{ $property->title }} </div>
                <div class="card-body"> {{ $property->description }} </div>
                <a href="" class="btn btn-primary"> View </a>
            </div>
        </div>
        
    @endforeach
    @endif
</div>


@endsection