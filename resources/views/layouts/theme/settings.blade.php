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
