<!-- [ Main Content ] start -->
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
                      <img src="{{ asset($item->getImageRoute($item->path_foto_perfil)) }}" alt="foto perfil" class="{{ ($item->path_foto_perfil === null) ? '' : 'img-radius' }} align-top m-r-15" style="width: 40px" />
                      {{--
                      <div class="d-inline-block">
                        <h6 class="m-b-0">
                          Quinn Flynn
                        </h6>
                        <p class="m-b-0 text-primary">
                          Android developer
                        </p>
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
                    <span class="badge bg-light-danger">Disactivado</span>
                    @endif
                    <div class="overlay-edit">
                      <ul class="list-inline mb-0">
                        <li class="list-inline-item m-0">
                          <a href="#" class="avtar avtar-s btn btn-primary"><i class="ti ti-pencil f-18"></i></a>
                        </li>
                        <li class="list-inline-item m-0">
                          <a href="#" class="avtar avtar-s btn bg-white btn-link-danger"><i class="ti ti-trash f-18"></i></a>
                        </li>
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
</div>
<!-- [ Main Content ] end -->
