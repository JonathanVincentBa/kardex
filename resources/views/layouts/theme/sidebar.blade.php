<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ asset('../images/avatar5.png') }}"
            width="25" height="25" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
            <p class="app-sidebar__user-designation">Administrador</p>
        </div>
    </div>
    <ul class="app-menu">
        <li class="active">
            <a class="app-menu__item" data-active="true" href="{{ route('home') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-laptop"></i>
                <span class="app-menu__label">Administrativo</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item" href="{{url('clientes')}}"><i class="icon fa fa-circle-o"></i> Clientes</a></li>
                <li><a class="treeview-item" href="{{url('contacto-clientes')}}"><i class="icon fa fa-circle-o"></i> Contacto
                        Clientes</a></li>
                <li><a class="treeview-item" href="{{url('servicios')}}""><i class="icon fa fa-circle-o"></i> Servicios</a></li>
                <li><a class="treeview-item" href="{{url('tipo-servicios')}}"><i class="icon fa fa-circle-o"></i> Tipo de
                        servicio</a></li>
                <li><a class="treeview-item" href="{{url('asignar')}}"><i class="icon fa fa-circle-o"></i> Asignar</a></li>
                <li><a class="treeview-item" href="{{url('permisos')}}"><i class="icon fa fa-circle-o"></i> Permisos</a></li>
                <li><a class="treeview-item" href="{{url('roles')}}"><i class="icon fa fa-circle-o"></i> Roles</a></li>
                <li><a class="treeview-item" href="{{url('user')}}"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
            </ul>
        </li>

        <li>
            <a class="app-menu__item" href="{{url('control-archivos')}}">
                <i class="app-menu__icon fa fa-th-list"></i>
                <span class="app-menu__label">Control de archivos</span>
            </a>
        </li>


        {{-- <li>
            <a class="app-menu__item" href="#">
                <i class="app-menu__icon fa fa-solid fa-map-location-dot"></i>
                <span class="app-menu__label">Hoja de ruta</span>
            </a>
        </li> --}}
        <li>
            <a class="app-menu__item" href="{{url('ingreso-documentos')}}">
                <i class="app-menu__icon fa fa-file-text"></i>
                <span class="app-menu__label">Ingreso de documentos</span>
            </a>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="{{url('kardex')}}">
                <i class="app-menu__icon fa fa-edit"></i>
                <span class="app-menu__label">Kardex / Cartas</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="charts.html">
                <i class="app-menu__icon fa fa-pie-chart"></i>
                <span class="app-menu__label">Reportes</span>
            </a>
        </li>
       {{--  <li>
            <a class="app-menu__item" href="docs.html">
                <i class="app-menu__icon fa fa-file-code-o"></i>
                <span class="app-menu__label">Documentación</span>
            </a>
        </li> --}}
    </ul>
</aside>
