@include('common.modalHead')
<div>
    <form wire.ignore.self>
        <div class="row">
          <b><p>Solicitud de pago: {{ $selected_id == 0 ? '' : $selected_id }}</p><hr></b>

          {{-- * MOSTRAR INFO --}}
          @if ($showModal)
            @include('livewire.solicitud-pago.show')
          @endif

          @if (!$showModal)
          {{-- * Info SDP --}}
            @if (!is_array($info_sdp_selected))
                {{-- {{ $info_sdp_selected }} --}}
                <div class="row align-items-center mb-3">
                    <div class="col-sm-6 mb-2 mb-sm-0 text-end">
                        <p class="mb-0"><strong>Folio</strong></p>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 me-3">
                                {{ $info_sdp_selected->folio }}
                            </div>
                        </div><hr class="m-0">
                    </div>
                </div>

                <div class="row align-items-center mb-3">
                    <div class="col-sm-6 mb-2 mb-sm-0 text-end">
                        <p class="mb-0"><strong>Informacion Sdp</strong></p>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 me-3">
                                Monto total: ${{ $info_sdp_selected->monto }} MXN<br>
                                Estatus: {{ $info_sdp_selected->estatus }}<br>
                                Monto Comprobado: ${{ $info_sdp_selected->monto_comprobado }} MXN<br>
                            </div>
                        </div><hr class="m-0">
                    </div>
                </div>

            @endif
            {{-- * Nombre rol --}}
            <div class="col-sm-12 col-md-12 col-lg-12">

                <div class="form-group">
                    <label class="form-label">Cargar archivos (XML, PDF, JPG)</label>
                    <input type="file"
                        id="files"
                        wire:model="files"
                        class="form-control __focus_active
                            @error('files') border border-danger border-1 @enderror"
                        placeholder="Archivos"
                        required>
                        @error('files')
                            <span class="text-danger er">{{ $message }}</span>
                        @enderror
                </div>
                <div class="form-group" wire:loading wire:target="files">
                    <span class="text-info">Cargando archivos...</span>
                </div>

            </div>

            @if ($files && $files->getClientOriginalExtension() === 'xml')
                <div class="row align-items-center mb-3">

                    {{-- * Monto Capturado --}}
                    <div class="col-sm-12 col-md-6 col-lg-6 my-2">
                        <span class="m-0"><strong>Monto cargado: </strong></span>
                        <span class="me-3">${{ $monto_capturado }} MXN</span>
                        <hr class="m-0">
                    </div>
                    {{-- * UUID --}}
                    <div class="col-sm-12 col-md-6 col-lg-6 my-2">
                        <span class="m-0"><strong>UUID: </strong></span>
                        <span class="me-3">{{ $uuid }}</span>
                        <hr class="m-0">
                    </div>
                    {{-- * Fecha --}}
                    <div class="col-sm-12 col-md-6 col-lg-6 my-2">
                        <span class="m-0"><strong>Fecha: </strong></span>
                        <span class="me-3">{{ $fecha }}</span>
                        <hr class="m-0">
                    </div>
                    {{-- * Folio --}}
                    <div class="col-sm-12 col-md-6 col-lg-6 my-2">
                        <span class="m-0"><strong>Folio: </strong></span>
                        <span class="me-3">{{ $folio }}</span>
                        <hr class="m-0">
                    </div>

                    @if ($existe_uuid)
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="alert alert-danger" role="alert">
                                El archivo xml ya está asociado a una sdp.
                            </div>
                        </div>
                    @endif

                </div>
            @endif

            @if ($files && ($files->getClientOriginalExtension() === 'pdf' || $files->getClientOriginalExtension() === 'jpg'))
                {{-- * Monto Capturado --}}
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-label">Monto Capturado</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                id="monto_capturado"
                                wire:model="monto_capturado"
                                class="form-control
                                    @error('monto_capturado') border border-danger border-1 @enderror"
                                placeholder="Monto Cacturado"
                                aria-label="Amount (to the nearest dollar)"
                                require>
                        </div>
                        @error('monto_capturado')
                            <span class="text-danger er">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- * Fecha --}}
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group">
                        <label class="form-label">Fecha</label>
                        <input type="datetime-local"
                            id="fecha"
                            wire:model="fecha"
                            class="form-control
                                @error('fecha') border border-danger border-1 @enderror"
                            placeholder="Fecha"
                            min="{{ $dateMin }}"
                            max="{{ $dateMax }}"
                            required>
                        @error('fecha')
                            <span class="text-danger er">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endif

            {{-- * Estatus --}}
            {{-- <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <div class="form-check form-switch mt-3 ps-5 py-3">
                        <input type="checkbox"
                        id="status"
                        wire:model="status"
                        class="form-check-input input-success f-16"
                        {{ $status == 1 ? 'checked' : '' }}>
                        <label class="form-check-label pt-1">Activo</label>
                    </div>
                </div>
                @error('status')
                <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div> --}}

          @endif

        </div>
    </form>
    {{-- <h3>Archivos cargados</h3>
    <ul>
        @foreach (App\Models\ArchivosSdps::where('sdp_id', $selected_id)->get() as $archivo)
            <li>
                <a href="{{ Storage::url($archivo->ruta) }}" target="_blank">
                    {{ $archivo->ruta }}
                </a>
            </li>
        @endforeach
    </ul> --}}
</div>


    <!-- <p>Modal body End.</p> -->
    </div>
    <div class="modal-footer">
        <button type="button"
        {{-- wire:click="resetUI()" --}}
        class="btn btn-danger rounded"
        data-bs-dismiss="modal">CERRAR</button>
        @if ($selected_id === 0)
        <button type="button"
            wire:click="store()"
            wire:loading.attr="disabled"
            class="btn btn-info rounded">GUARDAR</button>
        @endif
        @if ($selected_id >= 1 && !$showModal && !$existe_uuid && $uuid != '')
            @if ($files && $files->getClientOriginalExtension() === 'xml')
                @if ($files === '')
                    <button type="button"
                        wire:click="update()"
                        wire:loading.attr="disabled"
                        wire:target='files'
                        class="btn btn-info rounded">ACTUALIZAR</button>
                @else
                    <button type="button"
                        wire:click="update()"
                        wire:loading.attr="disabled"
                        wire:target='update'
                        class="btn btn-info rounded">ACTUALIZAR</button>
                @endif
            @endif
        @endif
        @if ($selected_id >= 1 && !$showModal && !$existe_uuid)
            @if ($files && ($files->getClientOriginalExtension() === 'pdf' || $files->getClientOriginalExtension() === 'jpg'))
                @if ($files === '')
                    <button type="button"
                        wire:click="update()"
                        wire:loading.attr="disabled"
                        wire:target='files'
                        class="btn btn-info rounded">ACTUALIZAR</button>
                @else
                    <button type="button"
                        wire:click="update()"
                        wire:loading.attr="disabled"
                        wire:target='update'
                        class="btn btn-info rounded">ACTUALIZAR</button>
                @endif
            @endif
        @endif
    </div>
  </div>
</div>
</div>
{{-- @include('common.modalFooter') --}}

@script
  <script>
    // Se emite desde componente dynamicSelectController
    Livewire.on('optionSelected', (value) => {
        // Realizar alguna acción cuando se selecciona una opción
        console.log('Opción seleccionada:', value);
        // Aquí puedes actualizar el valor del otro campo o realizar cualquier otra acción necesaria
    });
    // Se emite desde componente padre
    Livewire.on('form-focus-error', function (value) {
      console.log('form-focus-error', value.firstName);
      const input = document.getElementById(value.firstName);
      input.focus();
      // input.select();
    });
  </script>
@endscript
