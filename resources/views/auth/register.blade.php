@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="card-title"><h1>{{ __('Register') }}</h1></div>
                    <hr>
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <label for="name"> {{__('Name')}} </label>
                                <input id="name" 
                                type="text" 
                                class="form-control" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="email"> {{__('Email')}} </label>
                                <input id="email" 
                                type="email" 
                                class="form-control" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="password"> {{__('Password')}} </label>
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm"> {{__('Confirm Password')}} </label>
                                <input id="password-confirm" 
                                    type="password" 
                                    class="form-control" 
                                    name="password_confirmation" 
                                    required>
                            </div>
                        </div>

                        <div class="form-group row text-right">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
