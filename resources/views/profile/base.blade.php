@extends('layouts.app-sidebar')


@section('sidebar')

    @component('profile.sidebar-component', ['data' => $data])
    @endcomponent

@endsection