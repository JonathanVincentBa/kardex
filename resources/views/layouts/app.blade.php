<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @include('layouts.theme.styles')
</head>

<body class="app sidebar-mini">
    <!-- Navbar-->
    @include('layouts.theme.header')
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>

    @include('layouts.theme.sidebar')

    <main class="app-content">
        <div class="app-title">
            
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="tile-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <!-- Essential javascripts for application to work-->
    @include('layouts.theme.scripts')
    @yield('scripts')
</body>

</html>
