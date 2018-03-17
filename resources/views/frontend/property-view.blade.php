@extends('layouts.app-sidebar-right')

@section('sidebar')

    @component('components.property-sidebar')
    @endcomponent

@endsection

@section('content')
    <h1> {{$property->title}} </h1>

    {{ $json }}
    <script type="application/json" id="prop_data">
        {!! $json !!}
    </script>
    
@endsection