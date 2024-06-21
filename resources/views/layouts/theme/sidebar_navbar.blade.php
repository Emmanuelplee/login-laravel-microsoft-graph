<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('app') }}" class="b-brand text-primary">
                <!-- ========   Change your logo Movil   ============ -->
                <img src="{{ asset('assets/images/logo_blanco.png') }}" alt="logo image" class="logo-lg pt-3" width="90%">
                <!-- <span class="badge bg-primary rounded-pill ms-2 theme-version">v1-m</span> -->
            </a>
        </div>

        <!-- [navbar content] start -->
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navegacion</label>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon"><i class="ph ph-gauge"></i></span>
                        <span class="pc-mtext">Administracion</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="{{ route('app') }}">Principal</a>
                        </li>

                        @can('Users_Index')
                            <li class="pc-item">
                                <a class="pc-link" href="{{ url('/usuarios') }}">Usuarios</a>
                            </li>
                        @endcan

                        @can('Roles_Index')
                            <li class="pc-item">
                                <a class="pc-link" href="{{ url('/roles') }}">Roles</a>
                            </li>
                        @endcan
                        @can('Permissions_Index')
                            <li class="pc-item">
                                <a class="pc-link" href="{{ url('/permisos') }}">Permisos</a>
                            </li>
                        @endcan
                        @can('Report_Permissions_Index')
                            <li class="pc-item">
                                <a class="pc-link" href="{{ url('/reporte-permisos') }}">Reportes Permisos</a>
                            </li>
                        @endcan
                        {{-- @can('Report_Permissions_Index') --}}
                            <li class="pc-item">
                                <a class="pc-link" href="{{ url('/registro-actividades') }}">Registro Actividades</a>
                            </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                @can('Assign_Index')
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-shield-check"></i></span>
                            <span class="pc-mtext">Asignar Permisos</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            <li class="pc-item">
                                <a class="pc-link" href="{{ url('/asignar-por-rol') }}">Por Rol</a>
                            </li>
                        </ul>
                    </li>
                @endcan
                {{-- @can('Assign_Index') --}}
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link">
                            <span class="pc-micon"><i class="ph ph-money"></i></span>
                            <span class="pc-mtext">Solicitud de pago</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu">
                            <li class="pc-item">
                                <a class="pc-link" href="{{ url('/solicitud-pago-spd') }}">SPD</a>
                            </li>
                            <li class="pc-item">
                                <a class="pc-link" href="#">OTRA</a>
                            </li>
                        </ul>
                    </li>
                {{-- @endcan --}}
            </ul>
        </div>
        <!-- [navbar content] end -->

    </div>
</nav>
