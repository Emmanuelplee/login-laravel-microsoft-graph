@include('common.modalHead')
<div>
    <form class="validate-me" id="validate-me" data-validate>
        <div class="row">
          <b><p>Usuario: {{ $selected_id }}</p><hr></b>

          <!-- email -->
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-floating mb-3">
              <input type="email"
                wire:model.blur="email"
                class="form-control"
                placeholder="Correo electrónico"
                value="correo@mspv.com.mx"
                wire:model.blur="email"
                disabled>
              <label>Correo electrónico</label>
            </div>
            {{-- @error('email')
                <span class="text-danger er">{{ $message }}</span>
              @enderror --}}
          </div>

          <!-- activo-->
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-check form-switch switch-lg mt-3">
              <input type="checkbox"
                wire:model.blur="activo"
                class="form-check-input input-success f-16"
                {{ $activo == 1 ? 'checked' : '' }}>
              <label class="form-check-label">Activo</label>
            </div>
            {{-- @error('email')
              <span class="text-danger er">{{ $message }}</span>
            @enderror --}}
          </div>

          <!-- Nombre usuario -->
          <div wire:ignore class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-floating mb-3">
              <input type="text"
                wire:model.blur="name"
                class="form-control"
                placeholder="Nombre"
                required>
              <label for="">Nombre</label>
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
          <div wire:ignore class="col-sm-6 col-md-6 col-lg-6">
            <div class="form-floating mb-3">
              <input type="text"
                wire:model.blur="surname"
                class="form-control"
                placeholder="Apellido"
                required>
              <label for="">Apellido</label>
            </div>
            {{-- @error('surname')
              <span class="text-danger er">{{ $message }}</span>
            @enderror --}}
          </div>

          <!-- Puestos -->
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
              <label>Puesto</label>
              <select  wire:model="id_puesto"
                class="form-control mb-3"
                name="puesto-select-choices"
                id="puesto-select-choices">
                <option value="ELEGIR_PUESTO" disabled>Selecciona un puesto</option>
                @foreach ($positions as $position)
                  <option value="{{ $position->id }}">{{ $position->nombre }}</option>
                @endforeach
              </select>
              {{-- @error('role')
                <span class="text-danger er">{{ $message }}</span>
              @enderror --}}
            </div>
          </div>


          <!-- roles -->
          <div  class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
              <label>Perfil</label>
              <select wire:model="id_role"
                class="form-control mb-3"
                name="role-select-choices"
                id="role-select-choices">
                <option value="ELEGIR_ROL" disabled>Selecciona un perfil</option>
                @foreach ($roles as $rol)
                  <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                @endforeach
              </select>
              {{-- @error('role')
                <span class="text-danger er">{{ $message }}</span>
              @enderror --}}
            </div>
          </div>

        </div>
    </form>
</div>
@include('common.modalFooter')

{{-- Input Select Buscador --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
      var selectPuesto = new Choices('#puesto-select-choices');
      var selectPerfil = new Choices('#role-select-choices');
    });
</script>
@endpush

@script
  <script>
    document.addEventListener('livewire:init', () => {
      // Se ejecuta después de cargar Livewire pero antes de que se inicialice
    })
    document.addEventListener('livewire:initialized', () => {
      // Se ejecuta inmediatamente después de que Livewire haya terminado de inicializarse
        var selectPuesto = new Choices('#puesto-select-choices');
        var selectPerfil = new Choices('#role-select-choices');
    })
  </script>
@endscript
