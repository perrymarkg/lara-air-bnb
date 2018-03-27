@extends('layouts.full-col')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="row mb-3">
            <div class="col-md-12">
                <example-component></example-component>
                <form method="POST" autocomplete="off" id="property_search">
                    <div>
                    <input type="text" class="form-control" name="place" autocomplete="false" placeholder="Search for a place">
                    <input type="text" class="form-control bg-white" id="check_in">
                    <input type="text" class="form-control bg-white" id="check_out">
                    <input type="text" class="form-control bg-white" name="guests"  placeholder="1 Guest" id="guests">
                    </div>
                    <button class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <div class="property-listing row"></div>
    </div>
    
</div>

<div class=" gmap-sidebar">
    <div class="gmap-wrapper col-md-4 px-0 properties">
        <div id="gmap_properties"></div>
    </div>
</div>


@endsection