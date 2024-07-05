<div>
    <div class="card">
        <div class="card-header">
            {{-- {{ $info_sdp_selected }} --}}
        </div>
        <div class="card-body">

          <div class="row align-items-center mb-3">
            <div class="col-sm-4 mb-2 mb-sm-0">
              <p class="mb-0"><strong>Folio</strong></p>
            </div>
            <div class="col-sm-8">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    {{ $info_sdp_selected->folio }}
                </div>
              </div>
            </div>
          </div><hr>

          <div class="row align-items-center mb-3">
            <div class="col-sm-4 mb-2 mb-sm-0">
              <p class="mb-0"><strong>Fecha SDP</strong></p>
            </div>
            <div class="col-sm-8">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    {{ $info_sdp_selected->fecha_hr_sdp }}
                </div>
              </div>
            </div>
          </div><hr>
          <div class="row align-items-center mb-3">
            <div class="col-sm-4 mb-2 mb-sm-0">
              <p class="mb-0"><strong>Monto SDP</strong></p>
            </div>
            <div class="col-sm-8">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    ${{ $info_sdp_selected->monto }} MXN
                </div>
              </div>
            </div>
          </div><hr>
          <div class="row align-items-center mb-3">
            <div class="col-sm-4 mb-2 mb-sm-0">
              <p class="mb-0"><strong>Estatus SDP</strong></p>
            </div>
            <div class="col-sm-8">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    {{ $info_sdp_selected->estatus }}
                </div>
              </div>
            </div>
          </div><hr>

          <div class="row align-items-center mb-3">
            <div class="col-sm-4 mb-2 mb-sm-0">
              <p class="mb-0"><strong>Informacion SDP</strong></p>
            </div>
            <div class="col-sm-8">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    Solicitante: {{ $info_sdp_selected->solicitante }} <br>
                    Sub conceptos: {{ $info_sdp_selected->sub_conceptos }} <br>
                    Cargo: {{ $info_sdp_selected->cargo }}
                </div>
              </div>
            </div>
          </div><hr>

          <div class="row align-items-center mb-3">
            <div class="col-sm-4 mb-2 mb-sm-0">
              <p class="mb-0"><strong>Comprobado</strong></p>
            </div>
            <div class="col-sm-8">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    Monto: ${{ $info_sdp_selected->monto_comprobado }} MXN<br>
                    Xml estatus:
                        @if ($info_sdp_selected->mxml_estatus)
                            <span class="py-1 badge bg-success" style="opacity: 1">Existen</span>
                        @else
                            <span class="py-1 badge bg-danger" style="opacity: 1">No existen</span>
                        @endif <br>
                    Verificacion:
                        @if ($info_sdp_selected->aprobado)
                            <span class="py-1 badge bg-success" style="opacity: 1">Aprobado</span>
                        @else
                            <span class="py-1 badge bg-danger" style="opacity: 1">No Aprobado</span>
                        @endif <br>
                    Usuario: {{ $info_sdp_selected->user->alias }}
                </div>
              </div>
            </div>
          </div>

          {{-- <div class="row align-items-center mb-3">
            <div class="col-sm-4 mb-2 mb-sm-0">
              <p class="mb-0"><strong>Activo</strong></p>
            </div>
            <div class="col-sm-8">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">
                    @if ($status)
                        <span class="badge bg-success" style="opacity: 1">Activo</span>
                    @else
                        <span class="badge bg-danger" style="opacity: 1">Inactivo</span>
                    @endif
                </div>
              </div>
            </div>
          </div> --}}

        </div>
      </div>
</div>
