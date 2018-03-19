@component('layouts._head')
@endcomponent

    <div id="app">

        @component('components.header')
        @endcomponent
        
        <main>
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-12">
                        @yield('content')
                    </div>
                </div>  
            </div>          
        </main>

    </div>

@component('layouts._foot')
@endcomponent 
