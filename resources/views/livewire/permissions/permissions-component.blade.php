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
                <span>
                  <a href="#"
                    wire:click.prevent="storeShow()"
                    class="rounded btn btn-info fs-6"
                    data-bs-toggle="modal" data-bs-target="#theModal">
                    <i class="ti ti-plus" style="font-size: 1.5rem;"></i>
                  </a>
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
          <div class="table-card user-profile-list card-body">
            <div class="table-responsive">
              {{-- <span class="fs-6 fst-itali">
                {{ print_r(json_encode($data)) }}
              </span> --}}
              <livewire:permissions.PermissionsTableController :key="$tableControllerKey"/>
            </div>
          </div>
        </div>
      </div>
      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->

    <!-- Modal id="#theModal" -->
    @include('livewire.permissions.form')

  </div>
  <!-- [ Pc Content ] end -->
@script
  <script>
    // Se ejecuta inmediatamente después que Livewire se inizialeze
    document.addEventListener('livewire:initialized', () => {
    })
    // Registra una devolución gancho Livewire interno determinado
    Livewire.hook('morph.added',  ({ el, directiva, component, cleanup}) => {
    })
    // {{-- *========================================================= --}}
    //              EVENTOS DEL COMPONENTE PADRE
    Livewire.on('newPositionId', function (value) {
      console.log('Valor seleccionado id puesto o role componente dinamico:', value);
    });
    Livewire.on('item-added', (msg) => {
      console.log("item-added " + JSON.stringify(msg));
      $('#theModal').modal('hide');
      noty(msg[0],1);//Exito
    });
    Livewire.on('item-modal-edit', (msg) => {
      console.log("item-modal-edit " + JSON.stringify(msg));
      $('#theModal').modal('show');
    });
    Livewire.on('item-modal-updated', (msg) => {
      $('#theModal').modal('hide');
      noty(msg[0],1)//Exito
    });
    // {{-- *======================================================== --}}
    //            EVENTO DE ERROR
    Livewire.on('item-error', (msg) => {
      console.log('item-error msg:', msg)
      noty(msg[0],0)//Error
    });
    // {{-- *======================================================== --}}
    //            EVENTOS DE ELIMINACION
    Livewire.on('Confirm', (value) => {
        console.log('id,eventName,text', value.id, value.eventName, value.text);
        swal({
            title: 'Estas Seguro',
            text: value.text,
            type: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#dc3545',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'Eliminar',
            reverseButtons: true,
        }).then(function(result) {
            if (result.value) {
            Livewire.dispatch(value.eventName,[value.id]);
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
    Livewire.on('item-deleted', (msg) => {
      console.log('item-deleted msg:', msg)
      noty(msg[0],1)//Exito
      // setTimeout(() => Livewire.dispatch('refreshChildTable'), 5000);
      Livewire.dispatch('refreshChildTable')

    });
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

