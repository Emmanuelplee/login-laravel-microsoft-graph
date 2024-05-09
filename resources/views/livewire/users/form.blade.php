@include('common.modalHead')
<div>
    <form class="validate-me" id="validate-me" data-validate>
        <div class="row">
          <b><p>Usuario: {{ $selected_id }}</p><hr></b>

          <!-- email -->
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
              <label class="form-label">Correo electrónico</label>
              <input type="email"
                wire:model="email"
                class="form-control"
                placeholder="Correo electrónico"
                value="correo@mspv.com.mx"
                disabled>
            </div>
            {{-- @error('email')
                <span class="text-danger er">{{ $message }}</span>
              @enderror --}}
          </div>

          <!-- activo-->
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <div class="form-check form-switch mt-3 ps-5 py-3">
                    <input type="checkbox"
                    {{-- wire:model.live="activo" --}}
                    wire:model="activo"
                    class="form-check-input input-success f-16"
                    {{ $activo == 1 ? 'checked' : '' }}>
                    <label class="form-check-label pt-1">Activo</label>
                </div>
            </div>
            {{-- @error('email')
              <span class="text-danger er">{{ $message }}</span>
            @enderror --}}
          </div>

          <!-- Nombre usuario -->
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
              <label class="form-label">Nombre</label>
              <input type="text"
                wire:model="name"
                class="form-control"
                placeholder="Nombre"
                required>
              {{-- <small id="file-error-msg" class="form-text text-danger"></small> --}}
              {{-- <div class="error-message" id="bouncer-error_ date">Please fill out this field.</div> --}}
              {{-- <div class="error-message" id="bouncer-error_select">Please fill out this field.</div>
              <span class="text-danger er">Soy un error</span> --}}
            </div>
              {{-- @error('name')
                <span class="text-danger er">{{ $message }}</span>
              @enderror --}}
          </div>

          <!-- Apellido usuario -->
          <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="form-group">
              <label class="form-label">Apellido</label>
              <input type="text"
                wire:model="surname"
                class="form-control"
                placeholder="Apellido"
                required>
            </div>
            {{-- @error('surname')
              <span class="text-danger er">{{ $message }}</span>
            @enderror --}}
          </div>

          <!-- Puestos -->
          <div class="col-sm-12 col-md-6 col-lg-6">
              {{-- <livewire:users.dynamic-select-component --}}
              <livewire:users.dynamic-select-controller
              wire:model="id_puesto"
              :options="$positions"
              nameLabel="Puesto"
              optionDefault="Selecciona un puesto"
              />
            {{-- <div class="form-group">
              <label class="form-label">Puesto</label>
              <select  wire:model.live="id_puesto"
                class="form-control mb-3">
                <option value="ELEGIR_PUESTO" disabled>Selecciona un puesto</option>
                @foreach ($positions as $position)
                  <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
              </select>
            </div> --}}
          </div>


          <!-- roles -->
          <div  class="col-sm-12 col-md-6 col-lg-6">
              {{-- <livewire:users.dynamic-select-component --}}
            <livewire:users.dynamic-select-controller
                wire:model="id_role"
                :options="$roles"
                nameLabel="Perfil"
                optionDefault="Selecciona un perfil/rol"
                />
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
    Livewire.on('optionSelected', (value) => {
        // Realizar alguna acción cuando se selecciona una opción
        console.log('Opción seleccionada:', value);
        // Aquí puedes actualizar el valor del otro campo o realizar cualquier otra acción necesaria
    });
  </script>
@endscript
