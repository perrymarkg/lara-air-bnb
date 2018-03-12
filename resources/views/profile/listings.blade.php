@extends('profile.base')

@section('content')
<h1>{{__('My Listings')}}</h1>
<hr>

@component('ui.error-component')
@endcomponent

@component('ui.success-component')
@endcomponent



<div class="border rounded p-3 bg-white">
    <a href="{{ route('profile.listings.create') }}" class="btn btn-primary mb-3">Add Listing</a>
    
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
            @if( count($listings) > 0 )
            @foreach($listings as $listing)
                <tr>
                    <td>{{ $listing->title}}</td>
                    <td>
                        K: {{ $listing->max_kids }} | 
                        A: {{ $listing->max_adults }} |
                        B: {{ $listing->beds }} |
                        b: {{ $listing->baths }} |
                    </td>
                    <td>{{ $listing->country->name }}</td>
                    <td>
                        <a href="{{ route('profile.listings.edit', $listing->id) }}">E</a> | 
                        <a 
                            href="{{ route('profile.listings.destroy', $listing->id) }}" 
                            class="prompt-delete" 
                            data-type="Listing"
                            data-name="{{ $listing->title }}"
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

@component('ui.prompt-delete')
@endcomponent



@endsection