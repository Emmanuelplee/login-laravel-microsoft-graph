<div>
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">

          <div class="row align-items-center mb-3">
            <div class="col-sm-4 mb-2 mb-sm-0">
              <p class="mb-0">Nombre</p>
            </div>
            <div class="col-sm-8">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    {{ $name }}
                </div>
              </div>
            </div>
          </div>
          <hr>

          <div class="row align-items-center mb-3">
            <div class="col-sm-4 mb-2 mb-sm-0">
              <p class="mb-0">Descripcion</p>
            </div>
            <div class="col-sm-8">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    {{-- Nombre: {{ $id_role_tipo['nombre'] }} <br> --}}
                    {{ $description }}
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
</div>
