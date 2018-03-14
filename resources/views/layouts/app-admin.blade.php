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
            <nav class="navbar navbar-dark sticky-top navbar-expand-lg bg-secondary flex-md-nowrap p-0">
                <a class="navbar-brand col-sm-3 col-md-2 mr-0 bg-dark py-3" href="#">Company name</a>
                <div class="w-100">
                        <div class="row">
                            <div class="col-md-6">
                                Test
                            </div>
                            <div class="col-md-6">
                                Tests
                            </div>
                        </div>
                </div>
                <ul class="navbar-nav mb-0">
                    <li class="nav-item text-nowrap">
                        <span class="nav-link">{{ Auth::guard('admin')->user()->first_name }}</span>
                    </li>
                    <li class="nav-item text-nowrap pr-3">
                        <form action="{{ route('admin.logout')}}" method="POST">
                            {{ csrf_field() }}
                            <button class="btn btn-primary">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>

        
            <div class="container-fluid">
                <div class="row">
                    <nav class="col-md-2 d-md-block bg-secondary sidebar">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">Active</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" href="#">Disabled</a>
                                </li>
                            </ul>
                    </nav>
                    <main class="col-md-10 ml-sm-auto pt-3">
                            @yield('content')
                    </main>
                </div>
            </div>
            
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
