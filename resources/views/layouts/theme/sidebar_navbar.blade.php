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
                    <a href="#!" class="pc-link"><span class="pc-micon">
                            <i class="ph ph-gauge"></i></span><span class="pc-mtext">Administracion</span><span
                            class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="{{ route('app') }}">Principal</a></li>
                        <li class="pc-item"><a class="pc-link"
                                href="{{ url('/usuarios') }}">Usuarios</a></li>
                        <li class="pc-item"><a class="pc-link"
                                href="#">Vamos</a></li>
                    </ul>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon">
                            <i class="ph ph-layout"></i></span><span class="pc-mtext">Otros</span><span
                            class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="#">Compact</a></li>
                        <li class="pc-item"><a class="pc-link" href="#">Horizontal</a>
                        </li>
                        <li class="pc-item"><a class="pc-link" href="#">Tab</a></li>
                        <li class="pc-item"><a class="pc-link" href="#">Vertical</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- [navbar content] end -->

    </div>
</nav>
