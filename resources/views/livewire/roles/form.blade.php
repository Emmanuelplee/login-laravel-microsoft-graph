@include('common.modalHead')
<div>
    <form wire.ignore.self>
        <div class="row">
          <b><p>Rol: {{ $selected_id }}</p><hr></b>

          {{-- * MOSTRAR INFO --}}
          @if ($showModal)
            @include('livewire.roles.show')
          @endif

          @if (!$showModal)
            {{-- * Nombre rol --}}
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
                    {{-- <small id="file-error-msg" class="form-text text-danger">{{ $message }}</small> --}}
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
                </div>
            </div>

            {{-- * Rol tipo --}}

            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                <label class="form-label">Rol tipo</label>
                <select
                    id="id_role_tipo"
                    wire:model.live="id_role_tipo"
                    class="form-control mb-3">
                    <option value="ELEGIR" disabled>Selecciona un tipo de rol</option>
                    @foreach ($role_tipos as $value)
                     <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
                @error('id_role_tipo')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror
                </div>
            </div>

            {{-- * Estatus --}}
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                    <div class="form-check form-switch mt-3 ps-5 py-3">
                        {{-- <label class="form-check-label pt-1">Activo</label><br> --}}
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
            </div>

            {{-- * Ejemplo roles --}}
            {{-- <div  class="col-sm-12 col-md-6 col-lg-6">
                <livewire:users.dynamic-select-controller key='select-2'
                    idBox="choises-id-role"
                    wire:model="id_role"
                    :options="$roles"
                    nameLabel="Perfil"
                    optionDefault="Selecciona un perfil/rol"
                />
                @error('id_role')
                    <span class="text-danger er">{{ $message }}</span>
                @enderror --}}
                {{-- <div class="form-group">
                <label>Perfil</label>
                <select wire:model.live="id_role"
                    class="form-control mb-3">
                    <option value="ELEGIR_ROL" disabled>Selecciona un perfil</option>
                    @foreach ($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                    @endforeach
                </select>
                </div>
            </div> --}}
          @endif

        </div>
    </form>
</div>
@include('common.modalFooter')

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
