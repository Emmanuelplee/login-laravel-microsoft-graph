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
    <!-- [ Sidebar Menu ] start -->
    <nav class="pc-sidebar">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route('app') }}" class="b-brand text-primary">
                    <!-- ========   Change your logo from here   ============ -->
                    <img src="{{ asset('assets/images/logooscuro.png') }}" alt="logo image" class="logo-lg">
                    <span class="badge bg-primary rounded-pill ms-2 theme-version">v11.0</span>
                </a>
            </div>
            <div class="navbar-content">
                <ul class="pc-navbar">
                    <li class="pc-item pc-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link"><span class="pc-micon">
                                <i class="ph ph-gauge"></i></span><span class="pc-mtext">Dashboard</span><span class="pc-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="pc-submenu">
                            <li class="pc-item"><a class="pc-link" href="../dashboard/index.html">Sales</a></li>
                            <li class="pc-item"><a class="pc-link" href="../dashboard/index-analytics.html">Analytics</a></li>
                            <li class="pc-item"><a class="pc-link" href="../dashboard/index-affiliate.html">Affiliate</a></li>
                        </ul>
                    </li>
                    <li class="pc-item pc-hasmenu">
                        <a href="#!" class="pc-link"><span class="pc-micon">
                                <i class="ph ph-layout"></i></span><span class="pc-mtext">Layouts</span><span class="pc-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="pc-submenu">
                            <li class="pc-item"><a class="pc-link" href="../demo/layout-compact.html">Compact</a></li>
                            <li class="pc-item"><a class="pc-link" href="../demo/layout-horizontal.html">Horizontal</a></li>
                            <li class="pc-item"><a class="pc-link" href="../demo/layout-tab.html">Tab</a></li>
                            <li class="pc-item"><a class="pc-link" href="../demo/layout-vertical.html">Vertical</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="m-header">
            <a href="{{ route('app') }}" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{ asset('assets/images/logooscuro.png') }}" alt="logo image" class="logo-lg" width="150">
                <span class="badge bg-white text-dark rounded-pill ms-2 theme-version">v1.0</span>
            </a>
        </div>
        <!-- [Mobile Media Block] start -->
        <div class="header-wrapper">
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <!-- ======= Menu collapse Icon ===== -->
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ph ph-list"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ph ph-list"></i>
                        </a>
                    </li>
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none m-0" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <i class="ph ph-magnifying-glass"></i>
                        </a>
                        <div class="dropdown-menu pc-h-dropdown drp-search">
                            <form class="px-3">
                                <div class="form-group mb-0 d-flex align-items-center">
                                    <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . .">
                                    <button class="btn btn-light-secondary btn-search">Search</button>
                                </div>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <i class="ph ph-diamonds-four"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end pc-h-dropdown">
                            <a href="#!" class="dropdown-item">
                                <i class="ph ph-user"></i>
                                <span>My Account</span>
                            </a>
                            <a href="#!" class="dropdown-item">
                                <i class="ph ph-gear"></i>
                                <span>Settings</span>
                            </a>
                            <a href="#!" class="dropdown-item">
                                <i class="ph ph-lifebuoy"></i>
                                <span>Support</span>
                            </a>
                            <a href="#!" class="dropdown-item">
                                <i class="ph ph-lock-key"></i>
                                <span>Lock Screen</span>
                            </a>
                            <a href="#!" class="dropdown-item">
                                <i class="ph ph-power"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                    <li class="dropdown pc-h-item">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
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
                                                <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar avtar avtar-s">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 me-3 position-relative">
                                                        <h5 class="mb-0 text-truncate">Keefe Bond <span class="text-body"> added new tags to </span>
                                                            💪
                                                            Design system</h5>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <span class="text-sm text-muted">2 min ago</span>
                                                    </div>
                                                </div>
                                                <p class="position-relative text-muted mt-1 mb-2"><br><span class="text-truncate">Lorem Ipsum
                                                        has been
                                                        the industry's standard dummy text ever since the 1500s.</span></p>
                                                <span class="badge bg-light-primary border border-primary me-1 mt-1">web design</span>
                                                <span class="badge bg-light-warning border border-warning me-1 mt-1">Dashobard</span>
                                                <span class="badge bg-light-success border border-success me-1 mt-1">Design System</span>
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
                                                <p class="position-relative text-muted mt-1 mb-2"><br><span class="text-truncate"><strong> Jonny
                                                            aber
                                                        </strong> invites to join the challenge</span></p>
                                                <button class="btn btn-sm rounded-pill btn-outline-secondary me-2">Decline</button>
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
                                        <div class="d-grid"><button class="btn btn-outline-secondary">Mark all as read</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown pc-h-item header-user-profile">
                        <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" data-bs-auto-close="outside" aria-expanded="false">
                            <img src="{{ asset('assets/images/mspv.png') }}" alt="user-image" class="user-avtar">
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h4 class="m-0">Profile</h4>
                            </div>
                            <div class="dropdown-body">
                                <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                                    <ul class="list-group list-group-flush w-100">
                                        <li class="list-group-item">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('assets/images/favicon.png') }}" alt="user-image" class="wid-50 rounded-circle">
                                                </div>
                                                <div class="flex-grow-1 mx-3">
                                                    <?php
                                                        $nombre = explode(" ",MsGraph::get('me')['givenName']);
                                                        $apellido = explode(" ",MsGraph::get('me')['surname']);
                                                        $nombreCompleto = $nombre[0]. " ". $apellido[0];
                                                        strlen($nombreCompleto) <= 1 ? $nombreCompleto = MsGraph::get('me')['displayName'] : $nombreCompleto;
                                                    ?>
                                                    <h5 class="mb-0">{{ $nombreCompleto }}</h5>
                                                    <a class="link-primary" href="mailto:{{ MsGraph::get('me')['mail'] }}">{{ MsGraph::get('me')['mail'] }}</a>
                                                </div>
                                                {{-- <span class="badge bg-primary">PRO</span> --}}
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="dropdown-item">
                                                <span class="d-flex align-items-center">
                                                    <i class="ph ph-moon"></i>
                                                    <span>Dark mode</span>
                                                </span>
                                                <div class="form-check form-switch form-check-reverse m-0">
                                                    <input class="form-check-input f-18" id="dark-mode" type="checkbox" onclick="dark_mode()"
                                                        role="switch">
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="#" class="dropdown-item">
                                                <span class="d-flex align-items-center">
                                                    <i class="ph ph-user-circle"></i>
                                                    <span>Edit profile</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="{{ route('logout') }}" class="dropdown-item">
                                                <span class="d-flex align-items-center">
                                                    <i class="ph ph-power"></i>
                                                    <span>Logout</span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
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
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <div class="row">
                <div class="col-sm-6 my-1">
                    <p class="m-0">Copyright © 2024 MSPV by Funnel MKT. Todos los derechos reservados <a href="https://www.mspv.com.mx/"
                            target="_blank">MSPV</a></p>
                </div>
                {{-- <div class="col-sm-6 ms-auto my-1">
                    <ul class="list-inline footer-link mb-0 justify-content-sm-end d-flex">
                        <li class="list-inline-item"><a href="../index.html">Home</a></li>
                        <li class="list-inline-item"><a href="https://codedthemes.gitbook.io/gradient-able-bootstrap/"
                                target="_blank">Documentation</a></li>
                        <li class="list-inline-item"><a href="https://codedthemes.support-hub.io/" target="_blank">Support</a></li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </footer> <!-- Required Js -->
    <script src="../assets/js/plugins/popper.min.js"></script>
    <script src="../assets/js/plugins/simplebar.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/fonts/custom-font.js"></script>
    <script src="../assets/js/pcoded.js"></script>
    <script src="../assets/js/plugins/feather.min.js"></script>





    <script>layout_change('light');</script>




    <script>layout_sidebar_change('light');</script>



    <script>change_box_container('false');</script>


    <script>layout_caption_change('true');</script>




    <script>layout_rtl_change('false');</script>


    <script>preset_change("preset-1");</script>


    <script>header_change("header-1");</script>

    <div class="pct-c-btn">
        <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_pc_layout">
            <i class="ph ph-gear-six"></i>
        </a>
    </div>
    <div class="offcanvas border-0 pct-offcanvas offcanvas-end" tabindex="-1" id="offcanvas_pc_layout">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Settings</h5>
            <button type="button" class="btn btn-icon btn-link-danger" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="ti ti-x"></i></button>
        </div>
        <div class="pct-body customizer-body">
            <div class="offcanvas-body py-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="pc-dark">
                            <h6 class="mb-1">Theme Mode</h6>
                            <p class="text-muted text-sm">Choose light or dark mode or Auto</p>
                            <div class="row theme-color theme-layout">
                                <div class="col-4">
                                    <div class="d-grid">
                                        <button class="preset-btn btn active" data-value="true" onclick="layout_change('light');">
                                            <span class="btn-label">Light</span>
                                            <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-grid">
                                        <button class="preset-btn btn" data-value="false" onclick="layout_change('dark');">
                                            <span class="btn-label">Dark</span>
                                            <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-grid">
                                        <button class="preset-btn btn" data-value="default" onclick="layout_change_default();"
                                            data-bs-toggle="tooltip"
                                            title="Automatically sets the theme based on user's operating system's color scheme.">
                                            <span class="btn-label">Default</span>
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
                        <h6 class="mb-1">Sidebar Theme</h6>
                        <p class="text-muted text-sm">Choose Sidebar Theme</p>
                        <div class="row theme-color theme-sidebar-color">
                            <div class="col-6">
                                <div class="d-grid">
                                    <button class="preset-btn btn" data-value="true" onclick="layout_sidebar_change('dark');">
                                        <span class="btn-label">Dark</span>
                                        <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-grid">
                                    <button class="preset-btn btn active" data-value="false" onclick="layout_sidebar_change('light');">
                                        <span class="btn-label">Light</span>
                                        <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <h6 class="mb-1">Header color</h6>
                        <p class="text-muted text-sm">Choose your Header theme color</p>
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
                        <h6 class="mb-1">Accent color</h6>
                        <p class="text-muted text-sm">Choose your primary theme color</p>
                        <div class="theme-color preset-color">
                            <a href="#!" class="active" data-value="preset-1"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="preset-2"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="preset-3"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="preset-4"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="preset-5"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="preset-6"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="preset-7"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="preset-8"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="preset-9"><i class="ti ti-check"></i></a>
                            <a href="#!" data-value="preset-10"><i class="ti ti-check"></i></a>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <h6 class="mb-1">Sidebar Caption</h6>
                        <p class="text-muted text-sm">Sidebar Caption Hide/Show</p>
                        <div class="row theme-color theme-nav-caption">
                            <div class="col-6">
                                <div class="d-grid">
                                    <button class="preset-btn btn active" data-value="true" onclick="layout_caption_change('true');">
                                        <span class="btn-label">Caption Show</span>
                                        <span
                                            class="pc-lay-icon"><span></span><span></span><span><span></span><span></span></span><span></span></span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-grid">
                                    <button class="preset-btn btn" data-value="false" onclick="layout_caption_change('false');">
                                        <span class="btn-label">Caption Hide</span>
                                        <span
                                            class="pc-lay-icon"><span></span><span></span><span><span></span><span></span></span><span></span></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="pc-rtl">
                            <h6 class="mb-1">Theme Layout</h6>
                            <p class="text-muted text-sm">LTR/RTL</p>
                            <div class="row theme-color theme-direction">
                                <div class="col-6">
                                    <div class="d-grid">
                                        <button class="preset-btn btn active" data-value="false" onclick="layout_rtl_change('false');">
                                            <span class="btn-label">LTR</span>
                                            <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-grid">
                                        <button class="preset-btn btn" data-value="true" onclick="layout_rtl_change('true');">
                                            <span class="btn-label">RTL</span>
                                            <span class="pc-lay-icon"><span></span><span></span><span></span><span></span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item pc-box-width">
                        <div class="pc-container-width">
                            <h6 class="mb-1">Layout Width</h6>
                            <p class="text-muted text-sm">Choose Full or Container Layout</p>
                            <div class="row theme-color theme-container">
                                <div class="col-6">
                                    <div class="d-grid">
                                        <button class="preset-btn btn active" data-value="false" onclick="change_box_container('false')">
                                            <span class="btn-label">Full Width</span>
                                            <span class="pc-lay-icon"><span></span><span></span><span></span><span><span></span></span></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="d-grid">
                                        <button class="preset-btn btn" data-value="true" onclick="change_box_container('true')">
                                            <span class="btn-label">Fixed Width</span>
                                            <span class="pc-lay-icon"><span></span><span></span><span></span><span><span></span></span></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-grid">
                            <button class="btn btn-light-danger" id="layoutreset">Reset Layout</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
<!-- [Body] end -->

</html>
