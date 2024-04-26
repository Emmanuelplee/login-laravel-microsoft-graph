<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- [Head] start -->

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Gradient Able is trending dashboard template made using Bootstrap 5 design framework. Gradient Able is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
    <meta name="keywords"
        content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
    <meta name="author" content="codedthemes">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!-- [Google Font : Poppins] icon -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">
    <!-- [Mis Archivos CSS] -->
    <link rel="stylesheet" href="{{ asset('assets/css/mis-css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mis-css/nav-header.css') }}">

</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-header="header-1" data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true"
    data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- MARK:[Sidebar Movil] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route('app') }}" class="b-brand text-primary">
                    <!-- ========   Change your logo Movil   ============ -->
                    <img src="{{ asset('assets/images/logo_blanco.png') }}" alt="logo image" class="logo-lg pt-3"
                        width="90%">
                    <!-- <span class="badge bg-primary rounded-pill ms-2 theme-version">v1-m</span> -->
                </a>
            </div>
            <!-- MARK:[navbar content] start -->
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Navegacion</label>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link"><span class="pc-micon">
                                <i class="ph ph-gauge"></i></span><span class="pc-mtext">Principal</span><span
                                class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="pc-submenu">
                            <li class="pc-item"><a class="pc-link" href="../dashboard/index.html">Sales</a></li>
                            <li class="pc-item"><a class="pc-link"
                                    href="../dashboard/index-analytics.html">Analytics</a></li>
                            <li class="pc-item"><a class="pc-link"
                                    href="../dashboard/index-affiliate.html">Affiliate</a></li>
                        </ul>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link"><span class="pc-micon">
                                <i class="ph ph-layout"></i></span><span class="pc-mtext">Otros</span><span
                                class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="pc-submenu">
                            <li class="pc-item"><a class="pc-link" href="../demo/layout-compact.html">Compact</a></li>
                            <li class="pc-item"><a class="pc-link" href="../demo/layout-horizontal.html">Horizontal</a>
                            </li>
                            <li class="pc-item"><a class="pc-link" href="../demo/layout-tab.html">Tab</a></li>
                            <li class="pc-item"><a class="pc-link" href="../demo/layout-vertical.html">Vertical</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- [navbar content] end -->
        </div>
    </nav>
    <!-- [ nav sidebar Movil ] end -->
    <!-- MARK:[Header Topbar ] start -->
    <header class="pc-header">
        <div class="m-header">
            <a href="{{ route('app') }}" class="b-brand text-primary">
                <!-- ========   Change your logo Web   ============ -->
                <img src="{{ asset('assets/images/logo_blanco.png') }}" alt="logo image" class="logo-lg" width="70%">
                <!-- <span class="badge bg-white text-dark rounded-pill ms-2 theme-version">v1.0</span> -->
            </a>
        </div>
        <div class="header-wrapper">
            <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <!-- ======= Menu collapse Icon Web ===== -->
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ph ph-list"></i>
                        </a>
                    </li>
                    <!-- ======= Menu collapse Icon Movil ===== -->
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ph ph-list"></i>
                        </a>
                    </li>
                    <!-- ======= Search [Web y Movil] ===== -->
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ph ph-magnifying-glass"></i>
                        </a>
                        <div class="dropdown-menu pc-h-dropdown drp-search">
                            <form class="px-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <input type="search" class="form-control border-0 shadow-none"
                                        placeholder="Buscar aqui. . .">
                                    <button class="btn btn-light-secondary btn-search">Buscar</button>
                                </div>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">
                    <!-- MARK:[Notification] -->
                    <li class="dropdown pc-h-item" hidden>
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ph ph-bell"></i>
                            <span class="badge bg-success pc-h-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h4 class="m-0">Notifications</h4>
                                <ul class="list-inline ms-auto mb-0">
                                    <li class="list-inline-item">
                                        <a href="#" class="avtar avtar-s btn-link-hover-primary">
                                            <i class="ti ti-arrows-diagonal f-18"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="avtar avtar-s btn-link-hover-danger">
                                            <i class="ti ti-x f-18"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown-body text-wrap header-notification-scroll position-relative"
                                style="max-height: calc(100vh - 235px)">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <p class="text-span">Today</p>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="../assets/images/user/avatar-2.jpg" alt="user-image"
                                                    class="user-avtar avtar avtar-s">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 me-3 position-relative">
                                                        <h5 class="mb-0 text-truncate">Keefe Bond <span
                                                                class="text-body"> added new tags to </span>
                                                            💪
                                                            Design system</h5>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <span class="text-sm text-muted">2 min ago</span>
                                                    </div>
                                                </div>
                                                <p class="position-relative text-muted mt-1 mb-2"><br><span
                                                        class="text-truncate">Lorem Ipsum
                                                        has been
                                                        the industry's standard dummy text ever since the 1500s.</span>
                                                </p>
                                                <span class="badge bg-light-primary border border-primary me-1 mt-1">web
                                                    design</span>
                                                <span
                                                    class="badge bg-light-warning border border-warning me-1 mt-1">Dashobard</span>
                                                <span
                                                    class="badge bg-light-success border border-success me-1 mt-1">Design
                                                    System</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <p class="text-span">Yesterday</p>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <div class="avtar avtar-s bg-light-danger">
                                                    <i class="ph ph-user f-18"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 me-3 position-relative">
                                                        <h5 class="mb-0 text-truncate">Challenge invitation</h5>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <span class="text-sm text-muted">12 hour ago</span>
                                                    </div>
                                                </div>
                                                <p class="position-relative text-muted mt-1 mb-2"><br><span
                                                        class="text-truncate"><strong> Jonny
                                                            aber
                                                        </strong> invites to join the challenge</span></p>
                                                <button
                                                    class="btn btn-sm rounded-pill btn-outline-secondary me-2">Decline</button>
                                                <button class="btn btn-sm rounded-pill btn-primary">Accept</button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown-footer">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="d-grid"><button class="btn btn-primary">Archive all</button></div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-grid"><button class="btn btn-outline-secondary">Mark all as
                                                read</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- MARK:[Profile] start -->
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                            <!-- <img src="{{ asset('assets/images/mspv.png') }}" alt="user-image" class="user-avtar"> -->
                            <i class="ph ph-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h4 class="m-0">Perfil</h4>
                            </div>
                            <div class="dropdown-body">
                                <div class="profile-notification-scroll position-relative"
                                    style="max-height: calc(100vh - 225px)">
                                    <ul class="list-group list-group-flush w-100">
                                        <li class="list-group-item">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('assets/images/favicon.png') }}" alt="user-image"
                                                        class="wid-25">
                                                </div>
                                                <div class="flex-grow-1 mx-3">
                                                    <h5 class="mb-0">{{ $nombreCompleto }}</h5>
                                                    <a class="link-primary" href="mailto:test@test.com">{{ $user->email }}</a>
                                                </div>
                                                <!-- <span class="badge bg-primary">PRO</span> -->
                                            </div>
                                            <div class="d-flex aling-item-center">
                                                <div class="col-md-6 col-xl-6">
                                                    <div class="card user-card __mi_card">
                                                        <div class="card-body __mi_card_body">
                                                            <div class="saprator my-1">
                                                                <span class="px-1 py-1 badge bg-primary">Puesto</span>
                                                            </div>
                                                            <div class="row g-3 mb-1 text-center">
                                                                <div class="col-12 me-2 border-end">
                                                                    {{-- <small class="text-muted">Su Puesto</small> --}}
                                                                    {{-- <span class="badge bg-primary">Su Puesto</span> --}}
                                                                    <h6 class="mb-0">{{ $puesto->nombre }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-xl-6">
                                                    <div class="card user-card __mi_card">
                                                        <div class="card-body __mi_card_body">
                                                            <div class="saprator my-1">
                                                                <span class="px-1 py-1 badge bg-primary">Rol</span>
                                                            </div>
                                                            <div class="row g-3 mb-1 text-center">
                                                                <div class="col-12 ms-2">
                                                                    {{-- <small class="text-muted">Su Rol</small> --}}
                                                                    {{-- <span class="badge bg-primary">Su Rol</span> --}}
                                                                    <h6 class="mb-0">{{ $role->name }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                        <li class="list-group-item">
                                            <div class="dropdown-item">
                                                <span class="d-flex align-items-center">
                                                    <i class="ph ph-moon"></i>
                                                    <span>Modo oscuro</span>
                                                </span>
                                                <div class="form-check form-switch form-check-reverse m-0">
                                                    <input class="form-check-input f-18 __mi_cursor_pointer" id="dark-mode" type="checkbox"
                                                        onclick="dark_mode()" role="switch">
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="#" class="dropdown-item">
                                                <span class="d-flex align-items-center">
                                                    <i class="ph ph-user-circle"></i>
                                                    <span>Editar perfil</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="{{ route('logout') }}" class="dropdown-item">
                                                <span class="d-flex align-items-center">
                                                    <i class="ph ph-power"></i>
                                                    <span>Cerrar Sesion</span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- [Profile] end -->
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->


    <!-- MARK:[ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block card mb-0">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 ms-1">
                                        <h4 class="mb-0">Titulo de pagina | Listado</h4>
                                    </div>
                                    <span>
                                        <a href="#" class="rounded btn btn-button bg-info text-white">Creacion</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Seccion del Contenido</h5>
                            <hr>
                            @auth
                            <pre class="text-start" style="font-size: 1rem;">
                                {{-- {{ print_r($user) }} --}}
                                Hora de inicio secion: {{ $user->inicio_sesion }}
                                Puesto: {{ $puesto->nombre }}
                                Rol: {{ $role->name }}
                                ip Usuario: {{ $user->ip_equipo }}
                                  {{-- {{print_r(MsGraph::get('me'))}} --}}
                              </pre>
                            @endauth
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- MARK: [ Footer ] start -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm-8 my-1">
                    <p class="m-0">Copyright © 2024 MSPV by Funnel MKT. Todos los derechos reservados
                        <a class="text-primary" href="https://www.mspv.com.mx/" target="_blank">MSPV</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- [ Footer ] end -->
    <!-- MARK: Required Js -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    {{-- Funcionalidad de los Settings --}}
    <script>layout_change('light');</script>
    <script>layout_sidebar_change('light');</script>
    <script>change_box_container('false');</script>
    <script>layout_caption_change('false');</script>
    <script>layout_rtl_change('false');</script>
    <script>preset_change("preset-1");</script>
    <script>header_change("header-1");</script>
    {{-- MARK:[Settings] --}}
    <div class="pct-c-btn">
        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_pc_layout">
            <i class="ph ph-gear-six"></i>
        </a>
    </div>
    <div class="offcanvas border-0 pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Configuracion</h5>
            <button type="button" class="btn btn-icon btn-link-danger" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="ti ti-x"></i></button>
        </div>
        <div class="pct-body customizer-body">
            <div class="offcanvas-body py-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="pc-dark">
                            <h6 class="mb-1">Modo de tema</h6>
                            <p class="text-muted text-sm">Elige el modo claro, oscuro o automático</p>
                            <div class="row theme-color theme-layout">
                                <div class="col-4">
                                    <div class="d-grid">
                                        <button class="preset-btn btn active" data-value="true"
                                            onclick="layout_change('light');">
                                            <span class="btn-label">Claro</span>
                                            <span
                                                class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-grid">
                                        <button class="preset-btn btn" data-value="false"
                                            onclick="layout_change('dark');">
                                            <span class="btn-label">Oscuro</span>
                                            <span
                                                class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-grid">
                                        <button class="preset-btn btn" data-value="default"
                                            onclick="layout_change_default();" data-bs-toggle="tooltip"
                                            title="Automatically sets the theme based on user's operating system's color scheme.">
                                            <span class="btn-label">Defecto</span>
                                            <span class="pc-lay-icon d-flex align-items-center justify-content-center">
                                                <i class="ph ph-cpu"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <h6 class="mb-1">Color Menu</h6>
                        <p class="text-muted text-sm">Elija el color del menu lateral</p>
                        <div class="row theme-color theme-sidebar-color">
                            <div class="col-6">
                                <div class="d-grid">
                                    <button class="preset-btn btn" data-value="true"
                                        onclick="layout_sidebar_change('dark');">
                                        <span class="btn-label">Oscuro</span>
                                        <span
                                            class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-grid">
                                    <button class="preset-btn btn active" data-value="false"
                                        onclick="layout_sidebar_change('light');">
                                        <span class="btn-label">Claro</span>
                                        <span
                                            class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <h6 class="mb-1">Color Cabecera</h6>
                        <p class="text-muted text-sm">Elija el color de la cabecera</p>
                        <div class="theme-color header-color">
                            <a href="#!" class="active" data-value="header-1"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="header-2"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="header-3"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="header-4"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="header-5"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="header-6"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="header-7"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="header-8"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="header-9"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="header-10"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="header-11"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="header-12"><i class="ti ti-check"></i></a>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-grid">
                            <button class="btn btn-light-danger" id="layoutreset">Reiniciar Estilos</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
<!-- [Body] end -->

</html>
