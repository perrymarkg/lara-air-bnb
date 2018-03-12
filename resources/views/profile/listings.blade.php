@extends('profile.base')

@section('content')
<h1>{{__('My Listings')}}</h1>
<hr>
@if( !empty($listings) )
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
                        <a href="{{ route('profile.listings.edit', $listing->id) }}">E</a> | <a href="">D</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

@endsection