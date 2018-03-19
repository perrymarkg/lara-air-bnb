@extends('layouts.full-col')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="row">
            @if($properties)
            @foreach($properties as $property)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header"> {{ $property->title }} </div>
                        <div class="card-body"> {{ $property->description }} </div>
                        <a href=" {{ route('property.view', $property->id) }} " class="btn btn-primary"> View </a>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    </div>
    <div class="col-md-4 p-0">
        
    </div>
</div>


@endsection