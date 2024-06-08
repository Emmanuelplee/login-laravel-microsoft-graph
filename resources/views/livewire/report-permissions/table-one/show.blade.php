<div>
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">

            <ul class="list-group list-group-flush">
                @foreach ($permissionsUsers as $value)
                    <li class="list-group-item">{{ $value }}</li>
                @endforeach
            </ul>

            {{-- <div class="row align-items-center mb-3">
                <div class="col-sm-4 mb-2 mb-sm-0">
                <p class="mb-0"><strong>Nombre</strong></p>
                </div>
                <div class="col-sm-8">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 me-3">
                        {{ $name }}
                    </div>
                </div>
                </div>
            </div>
            <hr> --}}

            {{-- <div class="row align-items-center mb-3">
                <div class="col-sm-4 mb-2 mb-sm-0">
                <p class="mb-0"><strong>Rol tipo</strong></p>
                </div>
                <div class="col-sm-8">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 me-3">
                        Id: {{ $id_role_tipo['id'] }} <br>
                        Nombre: {{ $id_role_tipo['nombre'] }} <br>
                        Descripcion: {{ $id_role_tipo['descripcion'] }}
                    </div>
                </div>
                </div>
            </div>
            <hr> --}}

        </div>
      </div>
</div>
