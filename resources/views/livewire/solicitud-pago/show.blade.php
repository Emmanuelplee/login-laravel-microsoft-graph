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
                    ${{ number_format($info_sdp_selected->monto,2) }} MXN
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
                    Monto comprobado: ${{ number_format($info_sdp_selected->monto_comprobado, 2) }} MXN<br>
                    @if (($info_sdp_selected->monto - $info_sdp_selected->monto_comprobado) > 0)
                        <strong class="bg-light-danger">Monto por comprobar: ${{ number_format(($info_sdp_selected->monto - $info_sdp_selected->monto_comprobado),2) }} MXN</strong><br>
                    @else
                        <strong class="bg-light-success">Monto por comprobar: ${{ number_format(($info_sdp_selected->monto - $info_sdp_selected->monto_comprobado),2) }} MXN</strong><br>

                    @endif
                    Xml estatus:
                        @if ($info_sdp_selected->xml_estatus)
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
          </div><hr>

          <div class="row align-items-center mb-3">
            <div class="col-sm-4 mb-2 mb-sm-0">
              <p class="mb-0"><strong>Archivos Cargados</strong></p>
            </div>
            <div class="col-sm-8">
              <div class="d-flex align-items-center">
                <div class="flex-grow-1 me-3">

                    <div class="review-block">
                        @if (count($archivos_sdps_find) > 0)
                            @foreach ($archivos_sdps_find as $archivo)
                                @php
                                    $explode = explode('/', $archivo->ruta);
                                    $ruta = $explode[2];
                                @endphp
                                <div class="row align-items-center">

                                    <div class="col col-md-1 p-0">
                                        @if ($archivo->tipo === 'XML')
                                            <i class="ph ph-file-code bg-light-success  f-24"></i>
                                        @endif
                                        @if ($archivo->tipo === 'PDF')
                                            <i class="ph ph-file-pdf bg-light-success  f-24"></i>
                                        @endif
                                        @if ($archivo->tipo === 'IMAGEN')
                                            <i class="ph ph-file-image bg-light-success  f-24"></i>
                                        @endif
                                    </div>

                                    <div class="col col-md-7 p-0">
                                        <a href="{{ Storage::url($archivo->ruta) }}" target="_blank">
                                            {{ $ruta }}
                                        </a>
                                    </div>

                                    <div class="col col-md-2 p-0">
                                        <span>${{ number_format($archivo->monto, 2) }} MXN</span>
                                    </div>

                                    @if ($info_sdp_selected->estatus !== 'SOLICITUD PAGADA' && $info_sdp_selected->estatus !== 'SOLICITUD CANCELADA')
                                        <div class="col col-md-2 p-0">
                                            <a href="javascript:void(0)"
                                                wire:click.prevent="$dispatch('Confirm',
                                                    { id: {{ $archivo->id }},
                                                    eventName:'destroyFile',
                                                    text:'¿ESTA SEGURO DE ELIMINAR EL ARCHIVO?'})"
                                                class="avtar avtar-s btn btn-danger"
                                                style="width:30px; height:30px;">
                                                <i class="ti ti-trash f-18"></i>
                                            </a>
                                        </div>
                                    @endif

                                </div>
                                <hr class="my-1">
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col">
                                    <div class="row align-items-center">
                                        <div class="col-sm-auto p-r-0">
                                            <span>No hay archivos.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
</div>
