<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{{ asset('../images/AdminLTELogoWite.png') }}"
            width="25" height="25" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
            {{-- <p class="app-sidebar__user-designation">Administrador</p> --}}
        </div>
    </div>
    <ul class="app-menu">

        <li class="active">
            <a class="app-menu__item" data-active="true" href="{{ route('home') }}">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>

        @can('administrativo')
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-laptop"></i>
                    <span class="app-menu__label">Administrativo</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">

                    @can('clientes-index')
                        <li><a class="treeview-item" href="{{ url('clientes') }}"><i class="icon fa fa-circle-o"></i>
                                Clientes</a></li>
                    @endcan


                    @can('contacto-clientes.index')
                        <li><a class="treeview-item" href="{{ url('contacto-clientes') }}"><i class="icon fa fa-circle-o"></i>
                                Contacto
                                Clientes</a></li>
                    @endcan


                    @can('servicios.index')
                        <li><a class="treeview-item" href="{{ url('servicios') }}""><i class="icon fa fa-circle-o"></i>
                                Servicios</a></li>
                    @endcan


                    @can('servicios.index')
                        <li><a class="treeview-item" href="{{ url('tipo-servicios') }}"><i class="icon fa fa-circle-o"></i> Tipo
                                de
                                servicio</a></li>
                    @endcan


                    @can('asignar.index')
                        <li><a class="treeview-item" href="{{ url('asignar') }}"><i class="icon fa fa-circle-o"></i> Asignar</a>
                        </li>
                    @endcan


                    @can('permisos.index')
                        <li><a class="treeview-item" href="{{ url('permisos') }}"><i class="icon fa fa-circle-o"></i>
                                Permisos</a></li>
                    @endcan


                    @can('roles.index')
                        <li><a class="treeview-item" href="{{ url('roles') }}"><i class="icon fa fa-circle-o"></i> Roles</a>
                        </li>
                    @endcan


                    @can('usuarios.index')
                        <li><a class="treeview-item" href="{{ url('users') }}"><i class="icon fa fa-circle-o"></i>
                                Usuarios</a></li>
                    @endcan

                </ul>
            </li>
        @endcan

        @can('control-archivos.index')
            <li>
                <a class="app-menu__item" href="{{ url('control-archivos') }}">
                    <i class="app-menu__icon fa fa-th-list"></i>
                    <span class="app-menu__label">Control de archivos</span>
                </a>
            </li>
        @endcan


        {{-- <li>
            <a class="app-menu__item" href="#">
                <i class="app-menu__icon fa fa-solid fa-map-location-dot"></i>
                <span class="app-menu__label">Hoja de ruta</span>
            </a>
        </li> --}}
        @can('ingreso.index')
            <li>
                <a class="app-menu__item" href="{{ url('ingreso-documentos') }}">
                    <i class="app-menu__icon fa fa-file-text"></i>
                    <span class="app-menu__label">Correspondencia</span>
                </a>
            </li>
        @endcan
        @can('kardex.index')
            <li class="treeview">
                <a class="app-menu__item" href="{{ url('kardex') }}">
                    <i class="app-menu__icon fa fa-edit"></i>
                    <span class="app-menu__label">Kardex / Cartas</span>
                </a>
            </li>
        @endcan
        @can('reportes')
            <li class="treeview">
                <a class="app-menu__item" href="#" data-toggle="treeview">
                    <i class="app-menu__icon fa fa-pie-chart"></i>
                    <span class="app-menu__label">Reportes</span>
                    <i class="treeview-indicator fa fa-angle-right"></i>
                </a>
                <ul class="treeview-menu">
                    @can('reporte.cliente.view')
                        <li><a class="treeview-item" href="{{ url('cliente-reports') }}"><i class="icon fa fa-circle-o"></i>
                                Clientes</a></li>
                    @endcan
                    @can('reporte.control-archivo.view')
                        <li><a class="treeview-item" href="{{ url('control-archivos-reports') }}"><i
                                    class="icon fa fa-circle-o"></i>
                                Control de Archivos</a></li>
                    @endcan
                            @can ('reporte.correspondencia.view') 
                                
                        <li><a class="treeview-item" href="{{ url('correspondencia-reports') }}"><i
                                    class="icon fa fa-circle-o"></i>Correspondencia</a></li>
                            @endcan
                            @can ('reporte.cartas.view') 
                                
                        <li><a class="treeview-item" href="{{ url('cartas-reports') }}"><i class="icon fa fa-circle-o"></i>
                                Cartas</a></li>
                            @endcan
                </ul>

            </li>
        @endcan
        {{--  <li>
            <a class="app-menu__item" href="docs.html">
                <i class="app-menu__icon fa fa-file-code-o"></i>
                <span class="app-menu__label">Documentación</span>
            </a>
        </li> --}}
    </ul>
</aside>
