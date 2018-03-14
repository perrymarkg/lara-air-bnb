<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main class="container-fluid">
            <div class="row">
                <div class="col-md-5 mx-auto mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><h1>Admin Login</h1></div>
                            <hr>
                            <form class="form-horizontal" method="POST" action="{{ route('admin.login') }}">
                                {{ csrf_field() }}
        
                                <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 col-form-label text-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input 
                                            id="email" 
                                            type="text" 
                                            class="form-control" 
                                            name="email" 
                                            value="{{ old('email') }}" 
                                            required 
                                            autofocus>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 col-form-label text-right">Password</label>
        
                                    <div class="col-md-6">
                                        <input 
                                            id="password" 
                                            type="password" 
                                            class="form-control" 
                                            name="password" 
                                            required>
        
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>
        
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>


