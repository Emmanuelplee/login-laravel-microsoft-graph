@include('common.modalHead')
<div>
    {{-- <form class="validate-me" id="validate-me" data-validate> --}}
    <form wire.ignore>
        <div class="row">
          <b><p>Usuario: {{ $selected_id }}</p><hr></b>

          <!-- email -->
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
              <label class="form-label">Correo electrónico</label>
              <input type="email"
                id="email"
                wire:model="email"
                class="form-control"
                placeholder="Correo electrónico"
                value="correo@mspv.com.mx"
                disabled>
                @error('email')
                    <span class="text-danger er">{{ $message }}</span>
                  @enderror
            </div>
          </div>

          <!-- activo-->
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <div class="form-check form-switch mt-3 ps-5 py-3">
                    <input type="checkbox"
                      id="activo"
                      {{-- wire:model.live="activo" --}}
                      wire:model="activo"
                      class="form-check-input input-success f-16"
                      {{ $activo == 1 ? 'checked' : '' }}>
                    <label class="form-check-label pt-1">Activo</label>
                </div>
            </div>
            @error('activo')
              <span class="text-danger er">{{ $message }}</span>
            @enderror
          </div>

          <!-- Nombre usuario -->
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
              <label class="form-label">Nombre</label>
              <input type="text"
                id="name"
                wire:model="name"
                class="form-control"
                placeholder="Nombre"
                required>
                @error('name')
                {{-- <small id="file-error-msg" class="form-text text-danger">{{ $message }}</small> --}}
                <span class="text-danger er">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <!-- Apellido usuario -->
          <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
              <label class="form-label">Apellido</label>
              <input type="text"
                id="surname"
                wire:model="surname"
                class="form-control"
                placeholder="Apellido"
                required>
                @error('surname')
                  <span class="text-danger er">{{ $message }}</span>
                @enderror
            </div>
          </div>

          <!-- Puestos -->
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
              {{-- <livewire:users.dynamic-select-component --}}
              <livewire:users.dynamic-select-controller key='select-1'
                idBox="id_puesto"
                wire:model="id_puesto"
                :options="$positions"
                nameLabel="Puesto"
                optionDefault="Selecciona un puesto"
              />
              @error('id_puesto')
                <span class="text-danger er">{{ $message }}</span>
              @enderror
            </div>
          </div>


          <!-- roles -->
          <div  class="col-sm-12 col-md-6 col-lg-6">
              {{-- <livewire:users.dynamic-select-component --}}
            <livewire:users.dynamic-select-controller key='select-2'
                idBox="id_role"
                wire:model="id_role"
                :options="$roles"
                nameLabel="Perfil"
                optionDefault="Selecciona un perfil/rol"
              />
              @error('id_role')
                <span class="text-danger er">{{ $message }}</span>
              @enderror
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
