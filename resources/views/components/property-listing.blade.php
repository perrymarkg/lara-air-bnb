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
<div class="w-100 d-flex justify-content-center">
    {{ $properties->links() }}
</div>

@endif
