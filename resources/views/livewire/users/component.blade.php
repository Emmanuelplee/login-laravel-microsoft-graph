<!-- [ Pc Content ] start -->
<div class="pc-content">
  <!-- [ breadcrumb ] start -->
  <div class="page-header">
    <div class="page-block card mb-0">
      <div class="card-body">
        <div class="col-md-12">
          <div class="page-header-title">
            <div class="d-flex align-items-center">
              <div class="flex-grow-1 ms-1">
                <h4 class="mb-0">
                  {{ $componentName }} | {{ $pageTitle }}
                </h4>
              </div>
              <span hidden>
                <a href="#" class="rounded btn btn-button bg-info text-white">Creacion</a>
              </span>
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
        </div>
        --}}
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
                {{-- {{ $item }}
                --}}
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>
                    <div class="d-inline-block align-middle">
                      <img src="{{ asset($item->getImageRoute($item->path_foto_perfil)) }}"
                        alt="foto perfil"
                        class="{{ ($item->getImageRoute($item->path_foto_perfil) === 'assets/images/default.png') ? '' : 'img-radius' }} align-top m-r-15"
                        style="width: 40px" />
                      {{--
                      <div class="d-inline-block">
                        <h6 class="m-b-0">Quinn Flynn</h6>
                        <p class="m-b-0 text-primary">Android developer</p>
                      </div>
                      --}}
                    </div>
                  </td>
                  <td>{{ $item->email }}</td>
                  <td>
                    {{ $item->name }} {{ $item->surname }}
                  </td>
                  <td>{{ $item->position->nombre }}</td>
                  <td>{{ $item->role->name }}</td>
                  <td>
                    @if ($item->activo == 1)
                    <span class="badge bg-light-success">Activo</span>
                    @else
                    <span class="badge bg-light-danger">Bloqueado</span>
                    @endif
                    <div class="overlay-edit">
                      <ul class="list-inline mb-0">
                        {{-- <li class="list-inline-item m-0">
                          <a href="#" class="avtar avtar-s btn btn-primary">
                            <i class="ti ti-pencil f-18"></i>
                          </a>
                        </li> --}}
                        <li class="list-inline-item m-0">
                          <a href="javascript:void(0)"
                            wire:click.prevent="edit({{ $item->id }})"
                            class="avtar avtar-s btn btn-primary">
                            <i class="ti ti-pencil f-18"></i>
                          </a>
                        </li>
                        {{-- <li class="list-inline-item m-0">
                          <a href="javascript:void(0)"
                            class="avtar avtar-s btn bg-white btn-link-danger">
                            <i class="ti ti-trash f-18"></i>
                          </a>
                        </li> --}}
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

  <!-- [ Script table ] end -->
  <!-- [Page Specific JS] start -->
  <script src="{{ asset('assets/js/plugins/simple-datatables.js') }}"></script>
  <script>
      const dataTable = new simpleDatatables.DataTable('#pc-dt-simple', {
      sortable: false,
      searchable: true,
      perPage: 5
      });
  </script>
  <!-- [Page Specific JS] end -->

  <!-- Modal id="#theModal" -->
  @include('livewire.users.form')

</div>
<!-- [ Pc Content ] end -->
@script
  <script>
    Livewire.on('item-modal-edit', (postId) => {
      console.log("item-modal-edit " + postId);
      $('#theModal').modal('show');
    })
  </script>
@endscript
<script>
  document.addEventListener("livewire:load", function(event) {
    // window.livewire.on('item-added', msg => {
    // $('#theModal').modal('hide');
    // noty(msg)
    // });
    window.livewire.on('item-modal-edit', msg => {
        console.log('livewire:load');
    // $('#theModal').modal('show');
    });
    window.livewire.on('item-modal-updated', msg => {
    $('#theModal').modal('hide');
    // noty(msg)
    });
    // window.livewire.on('item-deleted', msg => {
    // $('#theModal').modal('hide');
    // noty(msg)
    // });
    // window.livewire.on('user-withsales', msg =>{
    //     noty(msg)
    // })
    /* Modal hide */
    window.livewire.on('modal-hide', msg => {
    console.log('Emit modal-hide msg:', msg)
    $('#theModal').modal('hide');
    });
    /* Modal borrar Errors del form */
    // $('#theModal').on('hidden.bs.modal', function(e) {
    // console.log('borrar errores y resetUI');
    // $('.er').css('display','none');
    // window.livewire.emit('resetUI');
    // });
    /* Modal focus input del form */
    // $('#theModal').on('shown.bs.modal', msg => {
    // $('.__focus_active').focus();
    // });
  });
</script>
