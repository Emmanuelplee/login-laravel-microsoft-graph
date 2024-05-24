@include('common.modalHead')
<div>
    <form wire.ignore.self>
        <div class="row">
          <b><p>Prmiso: {{ $selected_id == 0 ? '' : $selected_id }}</p><hr></b>

          {{-- * MOSTRAR INFO --}}
          @if ($showModal)
            @include('livewire.permissions.show')
          @endif

          @if (!$showModal)

            {{-- * Nombre Permiso --}}
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                <label class="form-label">Nombre</label>
                <input type="text"
                    id="name"
                    wire:model="name"
                    class="form-control __focus_active
                        @error('name') border border-danger border-1 @enderror"
                    placeholder="Nombre"
                    required>
                    @error('name')
                      <span class="text-danger er">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- * Descripcion Permiso --}}
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                <label class="form-label">Descripcion</label>
                <input type="text"
                    id="description"
                    wire:model="description"
                    class="form-control
                        @error('description') border border-danger border-1 @enderror"
                    placeholder="Descripcion"
                    required>
                    @error('description')
                      <span class="text-danger er">{{ $message }}</span>
                    @enderror
                </div>
            </div>

          @endif

        </div>
    </form>
</div>
@include('common.modalFooter')

@script
  <script>
    // Se emite desde componente padre
    Livewire.on('form-focus-error', function (value) {
      console.log('form-focus-error', value.firstName);
      // poner el foco en el primer error
      const input = document.getElementById(value.firstName);
      input.focus();
    });
  </script>
@endscript
