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
                  {{-- <a href="#" class="rounded btn btn-button bg-info text-white"
                      data-bs-toggle="modal" data-bs-target="#theModal">Crear</a> --}}
                <a href="javascript:void(0)"
                class="rounded btn btn-info fs-6">
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
              {{-- <table class="table table-hover" id="pc-dt-simple">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nombre Completo</th>
                    <th>Puesto</th>
                    <th>Rol</th>
                    <th>Activo</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $item)
                  @endforeach
                </tbody>
              </table> --}}
              {{-- <pre>
                {{ print_r(json_encode($data)) }}
              </pre> --}}
              <livewire:roles.RolesTableController  :key="$tableControllerKey"/>
              {{-- <livewire:users.dynamic-select-controller key='select-1'
              idBox="choises-id-puesto"
              wire:model="id_puesto"
              :options="$positions"
              nameLabel="Puesto"
              optionDefault="Selecciona un puesto"
              /> --}}
            </div>
          </div>
        </div>
      </div>
      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->

    <!-- Modal id="#theModal" -->
    @include('livewire.roles.form')

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
      Livewire.on('item-modal-edit', (msg) => {
        console.log("item-modal-edit " + JSON.stringify(msg));
        // Livewire.dispatch('afterEdit');// Por el selected_id no se carga la primera vez
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
      //            EVENTO DE ELIMINACION
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
      // =================================================================
      // Cerrar Modal form borrar Errors clase er y resetUI al controller
      $('#theModal').on('hidden.bs.modal', function(e) {
          console.log('borrar errores y resetUI');
          $('.er').css('display','none');
          Livewire.dispatch('resetUI');
      });
      // Focus primer input del Modal form clase __focus_active
      $('#theModal').on('shown.bs.modal', msg => {
          $('.__focus_active').focus();
        });
    </script>
  @endscript

