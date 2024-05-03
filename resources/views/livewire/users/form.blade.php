@include('common.modalHead')
<div class="row">
  <p>Usuario: {{ $selected_id }}</p><hr>
  <!-- email -->
  <div class="col-sm-12 col-md-6 col-lg-6">
    <div class="form-floating mb-3">
      <input type="email"
        wire:model.lazy="email"
        class="form-control"
        placeholder="Correo electrónico"
        value="correo@mspv.com.mx"
        wire:model.lazy="email"
        disabled>
      <label>Correo electrónico</label>
    </div>
    {{-- @error('email')
        <span class="text-danger er">{{ $message }}</span>
      @enderror --}}
  </div>
  <!-- email-old-->
  <div class="col-sm-12 col-md-6 col-lg-6">
    <div class="form-check form-switch switch-lg mt-3">
      <input type="checkbox"
        wire:model.lazy="activo"
        class="form-check-input input-success f-16"
        {{ $activo == 1 ? 'checked' : '' }}>
      <label class="form-check-label">Activo</label>
    </div>
    {{-- @error('email')
      <span class="text-danger er">{{ $message }}</span>
    @enderror --}}
  </div>
  <!-- Nombre usuario -->
  <div class="col-sm-12 col-md-6 col-lg-6">
    <div class="form-floating mb-3">
      <input type="text"
        wire:model.lazy="name"
        class="form-control"
        placeholder="Nombre"
        required>
      <label for="">Nombre</label>
    </div>
      {{-- @error('name')
        <span class="text-danger er">{{ $message }}</span>
      @enderror --}}
  </div>
  <!-- Apellido usuario -->
  <div class="col-sm-6 col-md-6 col-lg-6">
    <div class="form-floating mb-3">
      <input type="text"
        wire:model.lazy="surname"
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
      <select  wire:model.lazy="id_puesto"
        class="form-control mb-3"
        name="puesto-select-choices"
        id="puesto-select-choices">
        <option value="elegir_puesto">Selecciona un puesto</option>
        @foreach ($puestos as $puesto)
          <option value="{{ $puesto->id }}">{{ $puesto->nombre }}</option>
        @endforeach
      </select>
      {{-- @error('role')
        <span class="text-danger er">{{ $message }}</span>
      @enderror --}}
    </div>
  </div>


  <!-- roles -->
  <div class="col-sm-12 col-md-6 col-lg-6">
    <div class="form-group">
      <label>Perfil</label>
      <select wire:model.lazy="id_role"
        class="form-control mb-3"
        name="role-select-choices"
        id="role-select-choices">
        <option value="elegir_rol">Selecciona un perfil</option>
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
@include('common.modalFooter')

{{-- Input Select Buscador --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
      var selectPuesto = new Choices('#puesto-select-choices');
      var selectPerfil = new Choices('#role-select-choices');
    });
</script>
