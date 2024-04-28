<header class="pc-header">
    <div class="m-header">
        <a href="{{ route('app') }}" class="b-brand text-primary">
            <!-- ========   Change your logo Web   ============ -->
            <img src="{{ asset('assets/images/logo_blanco.png') }}" alt="logo image" class="logo-lg" width="70%">
            <!-- <span class="badge bg-white text-dark rounded-pill ms-2 theme-version">v1.0</span> -->
        </a>
    </div>
    <div class="header-wrapper">
        <!-- [Icon menu y buscar] start -->
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
        <!-- [Icon menu y buscar] end -->
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
                                            <div class="flex-shrink-0 round">
                                                @if ($data['image'] == 'assets/images/default.png')
                                                <img src="{{ asset('assets/images/default.png') }}" alt="user-image" class="rounded wid-35">
                                                @else
                                                <img src="{{ asset($data['image']) }}" alt="user-image" class="rounded-circle wid-40">
                                                @endif
                                            </div>
                                            <div class="flex-grow-1 mx-3">
                                                <h5 class="mb-0">{{ $data['nombre_completo'] }}</h5>
                                                <a class="link-primary" href="mailto:test@test.com">{{ $data['email'] }}</a>
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
                                                                <h6 class="mb-0">{{ $data['puesto'] }}</h6>
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
                                                                <h6 class="mb-0">{{ $data['role'] }}</h6>
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
