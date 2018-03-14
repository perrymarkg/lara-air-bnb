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
        <li class="nav-item text-nowrap pr-3">
            <span class="nav-link">{{ Auth::guard('admin')->user()->first_name }}</span>
        </li>
        <li class="nav-item text-nowrap pr-3">
            <form action="{{ route('admin.logout')}}" method="POST">
                {{ csrf_field() }}
                <button class="btn btn-primary">Logout</button>
            </form>
        </li>
        <li class="nav-item text-nowrap pr-3">
            <a href="/" class="btn btn-secondary">View Frontend</a>
        </li>
    </ul>
</nav>