@extends('profile._base')

@section('content')
<h1>{{__('Properties')}}</h1>
<hr>

@component('components.ui.error')
@endcomponent

@component('components.ui.success')
@endcomponent



<div class="border rounded p-3 bg-white">
    <a href="{{ route('profile.properties.create') }}" class="btn btn-primary mb-3">Add Property</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Details</th>
                <th>Country</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if( count($properties) > 0 )
            @foreach($properties as $property)
                <tr>
                    <td>{{ $property->title}}</td>
                    <td>
                        K: {{ $property->max_kids }} | 
                        A: {{ $property->max_adults }} |
                        B: {{ $property->beds }} |
                        b: {{ $property->baths }} |
                    </td>
                    <td>{{ $property->country->name }}</td>
                    <td>
                        <a href="{{ route('profile.properties.edit', $property->id) }}">E</a> | 
                        <a 
                            href="{{ route('profile.properties.destroy', $property->id) }}" 
                            class="prompt-delete" 
                            data-type="Property"
                            data-name="{{ $property->title }}"
                            >D</a>
                    </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">No Listings available yet!</td>
                </tr>
            @endif
        </tbody>
    </table>
    
</div>

@component('components.ui.prompt-delete')
@endcomponent



@endsection