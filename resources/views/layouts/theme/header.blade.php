<header class="app-header">
    <a class="app-header__logo" href="{{route('home')}}">
        <img src="{{asset('images/logo-white.png')}}" width="100" height="45" alt="">
    </a>
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <ul class="app-nav">
        <li class="dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                <img class="app-sidebar__user-avatar" src="{{ asset('../images/AdminLTELogoWite.png') }}" width="25"
                    height="25" alt="User Image">
                {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                        <i class="fa fa-sign-out fa-lg"></i>
                        Salir
                    </a>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</header>
