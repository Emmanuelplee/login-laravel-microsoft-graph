<!-- [ Pc Content ] start -->
<div class="pc-content pt-4">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block card mb-0">
        <div class="card-body py-0">
          <div class="col-md-12">
            <div class="page-header-title">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 ms-1">
                  <h4 class="mb-0 py-3">{{ $componentName }} | {{ $pageTitle }}</h4>
                </div>
                {{-- <span>
                  <a href="#" class="rounded btn btn-button bg-info text-white"
                      data-bs-toggle="modal" data-bs-target="#theModal">Crear</a>
                </span> --}}
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

            <div class="card card-header py-0 mb-0">

                  <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link {{ $stepTable == 1 ? 'active' : ''}}"
                        id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-selected="false">
                        <i class="ph ph-user-circle-plus me-2"></i> {{ $componentName }}
                      </a>
                    </li>
                    {{-- <li class="nav-item">
                      <a class="nav-link {{ $stepTable == 2 ? 'active' : ''}}"
                        id="followers-tab" data-bs-toggle="tab" href="#followers" role="tab" aria-selected="false">
                        <i class="ph ph-file-lock me-2"></i>  Permisos por rol
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ $stepTable == 3 ? 'active' : ''}}"
                        id="friends-tab" data-bs-toggle="tab" href="#friends" role="tab" aria-selected="false">
                        <i class="ph ph-shield-check me-2"></i> Permisos por rol y usuario
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link {{ $stepTable == 4 ? 'active' : ''}}"
                        id="gallery-tab" data-bs-toggle="tab" href="#gallery" role="tab" aria-selected="false">
                        <i class="ph ph-users-three me-2"></i> Usuarios por permiso
                      </a>
                    </li> --}}
                  </ul>

            </div>

            <div class="card-body pt-0 pb-1">
                {{-- <div class="col-lg-8 col-xxl-9"></div> --}}
              <div class="col-lg-12 col-xxl-12">
                <div wire:ignore class="tab-content">
                    <div class="tab-pane show active" id="profile" role="tabpanel">

                        <div class="h4 py-2">{{ $componentName }}</div>
                        <div class="table-card user-profile-list">
                          <div class="table-responsive">

                             {{-- <span class="fs-6 fst-itali">{{ print_r(json_encode($data)) }}</span> --}}
                            <livewire:PaymentRequests.PaymentRequestsSpdTableController />

                          </div>
                        </div>

                    </div>
                    {{-- <div class="tab-pane" id="followers" role="tabpanel" aria-labelledby="followers-tab">

                        <div class="h4 py-2">Permisos por rol</div>
                        <div class="table-card user-profile-list">
                          <div class="table-responsive">

                            <livewire:ReportPermissions.TableTwoPermissionsByRoles />

                          </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="friends" role="tabpanel" aria-labelledby="friends-tab">

                        <div class="h4 py-2">Permisos por rol y usuarios</div>
                        <div class="table-card user-profile-list">
                          <div class="table-responsive">

                            <livewire:ReportPermissions.TableThreePermissionsByRolAndUsers />

                          </div>
                        </div>

                    </div>
                    <div class="tab-pane" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">

                        <div class="h4 py-2">Usuarios por permiso</div>
                        <div class="table-card user-profile-list">
                          <div class="table-responsive">

                              <livewire:ReportPermissions.TableFourUsersByPermission />

                          </div>
                        </div>

                    </div> --}}
                </div>
              </div>
            </div>

        </div>
      </div>

      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->

    <!-- Modal id="#theModal" -->
    {{-- @include('livewire.activity-log.form') --}}

  </div>
  <!-- [ Pc Content ] end -->
@script
  <script>
    // {{-- *========================================================= --}}
    //              EVENTOS DEL CONTROLLER
    Livewire.on('item-modal-edit', (msg) => {
        console.log("item-modal-edit " + JSON.stringify(msg));
        $('#theModal').modal('show');
    });
    // {{-- *======================================================== --}}
    //            EVENTO DE ERROR DEL CONTROLLER
    Livewire.on('item-error', (msg) => {
        console.log('item-error msg:', msg)
        noty(msg[0],0)//Error
    });
    // {{-- *=========================================================== --}}
    //            CERRAR MODAL
    $('#theModal').on('hidden.bs.modal', function(e) {
        console.log('borrar Errors clase(er) ejecutar resetUI');
        $('.er').css('display','none');
        Livewire.dispatch('resetUI');
    });
  </script>
@endscript
