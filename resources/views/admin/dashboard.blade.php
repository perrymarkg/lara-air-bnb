@extends('admin.base')

@section('content')
<h1>Welcome {{ Auth::guard('admin')->user()->first_name}}</h1>
        
@endsection