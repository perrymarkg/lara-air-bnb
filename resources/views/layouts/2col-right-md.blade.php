@component('layouts._head')
@endcomponent

    <div id="app">
        
        @component('components.header')
        @endcomponent

        <main>
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-8">
                        @yield('content')
                    </div>
                    <div class="col-md-4">
                        @section('sidebar')
                        @show
                    </div>
                    
                </div>
            </div>
            
        </main>
    </div>
@component('layouts._foot')
@endcomponent

