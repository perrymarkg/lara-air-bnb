@extends('layouts.full-col')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="row">
            @if($properties)
            @foreach($properties as $property)
                <div class="col-md-4">
                    <div class="card mb-4 prop" id="prop_{{$property->id}}" data-id="{{$property->id}}">
                        <div class="card-header"> {{ $property->title }} </div>
                        <div class="card-body"> {{ $property->description }} </div>
                        <a href=" {{ route('property.view', $property->id) }} " class="btn btn-primary"> View </a>
                    </div>
                </div>
            @endforeach
            <script type="application/json" id="prop_markers" data-pin="{{ asset('storage/pin.png') }}" data-pinhover="{{ asset('storage/pin-hover.png')}}">
                {!! $markers !!}
            </script>
            @endif
        </div>
    </div>
    
</div>

<div class=" gmap-sidebar">
    <div class="gmap-wrapper col-md-4 px-0 properties">
        <div id="gmap_properties"></div>
    </div>
</div>


@endsection