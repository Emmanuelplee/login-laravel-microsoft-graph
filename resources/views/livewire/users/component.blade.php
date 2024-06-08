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
              <span hidden>
                <a href="#" class="rounded btn btn-button bg-info text-white"
                    data-bs-toggle="modal" data-bs-target="#theModal">Modal</a>
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
        {{--
        <div class="card-header">
          <h5>Seccion del Contenido</h5>
        </div> --}}
        {{-- <div wire:ignore class="table-card user-profile-list card-body"> --}}
        <div class="table-card user-profile-list card-body">
          <div class="table-responsive">
            <table class="table table-hover" id="pc-dt-simple">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Imagen</th>
                  <th>Correo</th>
                  <th>Nombre Completo</th>
                  <th>Puesto</th>
                  <th>Rol</th>
                  <th>Activo</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $item)
                {{-- {{ $item }} --}}
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>
                    <div class="d-inline-block align-middle">
                      <img src="{{ asset($item->getImageRoute($item->path_foto_perfil)) }}"
                        alt="foto perfil"
                        class="{{ ($item->getImageRoute($item->path_foto_perfil) === 'assets/images/default.png') ? '' : 'img-radius' }} align-top m-r-15"
                        style="width: 40px" />
                    </div>
                  </td>
                  <td>{{ $item->email }}</td>
                  <td>
                    {{ $item->name }} {{ $item->surname }}
                  </td>
                  <td>{{ $item->position->nombre }}</td>
                  <td>{{ $item->my_role_is->name }}</td>
                  <td>
                    @if ($item->activo == 1)
                        @canany(['Users_Edit','Users_Delete'])
                            <span class="badge bg-light-success">Activo</span>
                        @endcanany
                        @if(auth()->user()->cannot('Users_Edit') && auth()->user()->cannot('Users_Delete'))
                        <span class="badge bg-light-success" style="opacity: 1">Activo</span>
                        @endif
                    @else
                        @canany(['Users_Edit','Users_Delete'])
                            <span class="badge bg-light-danger">Inactivo</span>
                        @endcanany
                        @if(auth()->user()->cannot('Users_Edit') && auth()->user()->cannot('Users_Delete'))
                            <span class="badge bg-light-danger" style="opacity: 1">Inactivo</span>
                        @endif
                    @endif
                    <div class="overlay-edit">
                      <ul class="list-inline mb-0">
                        {{-- <li class="list-inline-item m-0">
                          <a href="#" class="avtar avtar-s btn btn-primary">
                            <i class="ti ti-pencil f-18"></i>
                          </a>
                        </li> --}}
                        @can('Users_Edit')
                            <li class="list-inline-item m-0">
                            <a href="javascript:void(0)"
                                wire:click.prevent="edit({{ $item->id }})"
                                class="avtar avtar-s btn btn-primary">
                                <i class="ti ti-pencil f-18"></i>
                            </a>
                            </li>
                        @endcan
                        @can('Users_Delete')
                            <li class="list-inline-item m-0">
                            <a href="javascript:void(0)"
                                {{-- wire:confirm="¿CONFIRMAS ELINIMAR EL REGISTRO?" --}}
                                wire:click="$dispatch('Confirm',{ id: {{ $item->id }},eventName:'destroy',text:'¿ESTA SEGURO DE ELINIMAR EL REGISTRO?'})"
                                {{-- onclick="Confirm('{{$item->id}}','destroy','¿CONFIRMAS ELINIMAR EL REGISTRO?')" --}}
                                class="avtar avtar-s btn bg-white btn-link-danger">
                                <i class="ti ti-trash f-18"></i>
                            </a>
                            </li>
                        @endcan
                      </ul>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- [ sample-page ] end -->
  </div>
  <!-- [ Main Content ] end -->

  <!-- Modal id="#theModal" -->
  @include('livewire.users.form')

  <style>
    .pc-footer {
        margin-left: 0;
    }
  </style>
</div>
<!-- [ Pc Content ] end -->
@script
  <script>
    // Se ejecuta inmediatamente después de que Livewire haya terminado de inicializarse
    document.addEventListener('livewire:initialized', () => {
        const dataTableElement = document.getElementById('pc-dt-simple');
        if (dataTableElement !== null) {
            console.log('dataTableElement existe.');
            const dataTable = new simpleDatatables.DataTable("#pc-dt-simple", {
                sortable: false,
                searchable: true,
                perPage: 5,
                headings: true,
                labels: {
                    "placeholder": "Buscar...",
                    "searchTitle": "Buscar dentro de la tabla",
                    "perPage": "entradas por página",
                    "noRows": "entradas no encontradas",
                    "noResults": "Ningún resultado coincide con su consulta de búsqueda",
                    "info": "Mostrando {start} a {end} de {rows} entradas"
                },
            });
        }
    })
    // Registra una devolución de llamada para ejecutarla en un gancho Livewire interno determinado
    Livewire.hook('morph.added',  ({ el, directiva, component, cleanup}) => {
        // Tabla de la lista usuarios
        const dataTableElement = document.getElementById('pc-dt-simple');
        if (dataTableElement !== null) {
            console.log('dataTableElement existe.');
            const dataTable = new simpleDatatables.DataTable("#pc-dt-simple", {
                sortable: false,
                searchable: true,
                perPage: 5,
                headings: true,
                labels: {
                    "placeholder": "Buscar...",
                    "searchTitle": "Buscar dentro de la tabla",
                    "perPage": "entradas por página",
                    "noRows": "entradas no encontradas",
                    "noResults": "Ningún resultado coincide con su consulta de búsqueda",
                    "info": "Mostrando {start} a {end} de {rows} entradas"
                },
            });
        }
    })
    // =================================================================
    //              Eventos del componente padre
    Livewire.on('newPositionId', function (value) {
      console.log('Valor seleccionado id puesto o role componente dinamico:', value);
    });
    Livewire.on('item-modal-edit', (msg) => {
      console.log("item-modal-edit " + JSON.stringify(msg));
      Livewire.dispatch('afterEdit');// Por el selected_id no se carga la primera vez
      $('#theModal').modal('show');
    });
    Livewire.on('item-modal-updated', (msg) => {
      $('#theModal').modal('hide');
      noty(msg[0],1)//Exito
    });
    Livewire.on('item-deleted', (msg) => {
      console.log('item-deleted msg:', msg)
      noty(msg[0],1)//Exito
    });
    Livewire.on('item-error', (msg) => {
      console.log('item-error msg:', msg)
      noty(msg[0],0)//Error
    });
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

