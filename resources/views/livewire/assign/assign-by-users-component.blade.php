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
                  <a href="#"
                    wire:click.prevent="storeShow()"
                    class="rounded btn btn-info fs-6"
                    data-bs-toggle="modal" data-bs-target="#theModal">
                    <i class="ti ti-plus" style="font-size: 1.5rem;"></i>
                  </a>
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
            <div class="d-flex align-items-center">
                <span class="fs-5 p-1">Id:</span>
                <span class="badge rounded-pill text-bg-info" style="font-size: .95em">{{ $selected_id == 0 ? '' : $selected_id }}</span>
                <span class="fs-5 p-1">Nombre:</span>
                <span class="badge rounded-pill text-bg-info" style="font-size: .95em">{{ $userName }}</span>
                <span class="fs-5 p-1">Rol:</span>
                <span class="badge rounded-pill text-bg-info" style="font-size: .95em">{{ $roleName }}</span>
            </div>
          </div>
          <div class="table-card user-profile-list card-body">
            <div class="table-responsive">
              {{-- <span class="fs-6 fst-itali">
                {{ print_r(json_encode($data)) }}
              </span> --}}
              <livewire:assign.AssignByUsersTableController />
            </div>
          </div>
        </div>
      </div>
      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->

    <!-- Modal id="#theModal" -->
    {{-- @include('livewire.permissions.form') --}}

  </div>
  <!-- [ Pc Content ] end -->
@script
  <script>
    // {{-- *========================================================= --}}
    //              EVENTOS DEL CONTROLLER
    Livewire.on('sync-all', (msg) => {
      noty(msg[0],1)//Exito
    });
    Livewire.on('remove-all', (msg) => {
      noty(msg[0],1)//Exito
    });
    Livewire.on('sync-permiso', (msg) => {
      noty(msg[0],1)//Exito
    });
    // {{-- *======================================================== --}}
    //            EVENTO DE ERROR DEL CONTROLLER
    Livewire.on('sync-error', (msg) => {
      console.log('sync-error msg:', msg)
      noty(msg[0],0)//Error
    });
    // {{-- *======================================================== --}}
    //            EVENTOS DE CONFIMACION CON ALERT
    Livewire.on('Revocar', () => {
        console.log('Revocar');
        swal({
            title: 'Atención',
            text: '¿Confirmas revocar todos los permisos?',
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#dc3545',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Aceptar',
            reverseButtons: true,
        }).then(function(result) {
            if (result.value) {
            Livewire.dispatch('EventRemoveAll');
            swal.close()
            }else if(result.dismiss === Swal.DismissReason.cancel) {
                swal({
                    title: 'Cancelado',
                    text: 'No se realizó modificación',
                    type: 'error',
                    timer: 5000
                })
            }
        })
    })
    // {{-- *=========================================================== --}}
    //            CERRAR MODAL
    $('#theModal').on('hidden.bs.modal', function(e) {
        console.log('borrar Errors clase(er) ejecutar resetUI');
        $('.er').css('display','none');
        Livewire.dispatch('resetUI');
    });
    // Foco primer input del Modal clase __focus_active
    $('#theModal').on('shown.bs.modal', msg => {
        $('.__focus_active').focus();
      });
  </script>
@endscript

