<!-- [ Pc Content ] start -->
<div class="pc-content pt-4">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block card mb-0">
        <div class="card-body">
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

            <div class="card-header">
                <span class="h4 p-1">Permisos por usuario</span>
            </div>

          <div class="table-card user-profile-list card-body">
            <div class="table-responsive">
              {{-- <span class="fs-6 fst-itali">
                {{ print_r(json_encode($data)) }}
              </span> --}}
              <livewire:ReportPermissions.TableOnePermissionsByUsers />

            </div>
          </div>

        </div>
      </div>

      <div class="col-sm-12">
        <div class="card">

            <div class="card-header">
                <span class="h4 p-1">Permisos por rol</span>
            </div>

          <div class="table-card user-profile-list card-body">
            <div class="table-responsive">
              {{-- <span class="fs-6 fst-itali">
                {{ print_r(json_encode($data)) }}
              </span> --}}
              <livewire:ReportPermissions.TableTwoPermissionsByRoles />

            </div>
          </div>

        </div>
      </div>

      <div class="col-sm-12">
        <div class="card">

            <div class="card-header">
                <span class="h4 p-1">Permisos por rol y usuario</span>
            </div>

          <div class="table-card user-profile-list card-body">
            <div class="table-responsive">
              {{-- <span class="fs-6 fst-itali">
                {{ print_r(json_encode($data)) }}
              </span> --}}
              <livewire:ReportPermissions.TableThreePermissionsByRolAndUsers />

            </div>
          </div>

        </div>
      </div>

      <div class="col-sm-12">
        <div class="card">

            <div class="card-header">
                <span class="h4 p-1">Usuarios por permiso</span>
            </div>

          <div class="table-card user-profile-list card-body">
            <div class="table-responsive">
              {{-- <span class="fs-6 fst-itali">
                {{ print_r(json_encode($data)) }}
              </span> --}}
              <livewire:ReportPermissions.TableFourUsersByPermission />

            </div>
          </div>

        </div>
      </div>

      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->

    <!-- Modal id="#theModal" -->
    {{-- @include('livewire.users.form') --}}

  </div>
  <!-- [ Pc Content ] end -->
@script
  <script>
    // {{-- *========================================================= --}}
    //              EVENTOS DEL CONTROLLER
    Livewire.on('sync-permiso', (msg) => {
      noty(msg[0],1)//Exito
    });
    // {{-- *======================================================== --}}
    //            EVENTO DE ERROR DEL CONTROLLER
    Livewire.on('sync-error', (msg) => {
      console.log('sync-error msg:', msg)
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
