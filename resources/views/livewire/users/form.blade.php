@include('common.modalHead')
<div>
    {{-- <form class="validate-me" id="validate-me" data-validate> --}}
    <form wire.ignore.self>
        <div class="row">
          <b><p>Usuario: {{ $selected_id }}</p><hr></b>

          <!-- email -->
          <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
              <label class="form-label">Correo electrónico</label>
              <input type="email"
                id="email"
                wire:model="email"
                class="form-control
                @error('email') border border-danger border-1 @enderror"
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
              <label class="form-label">Nombre(s)</label>
              <input type="text"
                id="name"
                wire:model="name"
                class="form-control
                    @error('name') border border-danger border-1 @enderror"
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
              <label class="form-label">Apellidos</label>
              <input type="text"
                id="surname"
                wire:model="surname"
                class="form-control
                    @error('surname') border border-danger border-1 @enderror"
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
              {{-- <livewire:users.DynamicSelectController --}}
              <livewire:users.dynamic-select-controller key='select-1'
                idBox="choises-id-puesto"
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
              {{-- <livewire:users.DynamicSelectController --}}
            <livewire:users.dynamic-select-controller key='select-2'
                idBox="choises-id-role"
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
    // Registra una devolución de llamada para ejecutarla en un gancho Livewire interno determinado
    Livewire.hook('morph.added',  ({ el, component }) => {
        // console.log('hook morph.added');
        // Componente selects choices
        const selectsIdPuestos = document.getElementById('choises-id-puesto');
        const selectsIdRole = document.getElementById('choises-id-role');
        const defaultIdPuesto = $wire.$get('id_puesto');
        const defaultIdRole = $wire.$get('id_role');
        // Agrega un event listener para el evento 'change' del select
        selectsIdPuestos.addEventListener('change', function(event) {
            // console.log(event.target.value);
            $wire.$set('id_puesto', event.target.value)
        });
        selectsIdRole.addEventListener('change', function(event) {
            // console.log(event.target.value);
            $wire.$set('id_role', event.target.value)
        });
        if (selectsIdPuestos !== null && selectsIdRole !== null) {
            // console.log('choises-id-puesto y choises-id-role existe.');
            var config = {
                searchEnabled: true,
                itemSelectText: 'Seleccionar',
                noResultsText:"No se encontraron resultados",
                allowHTML: true,
            }
            var selectChoicesIdPuesto = new Choices('#choises-id-puesto', config);
            var selectChoicesIdRole = new Choices('#choises-id-role', config);
            // Agremas otro registro y lo seleccionamos
            // selectChoicesIdPuesto.setChoices([{value: '100', label:'OTRO PUESTO' selected:true}]);
            // Elegimos uno por default
            selectChoicesIdPuesto.setChoiceByValue(defaultIdPuesto.toString());
            selectChoicesIdRole.setChoiceByValue(defaultIdRole.toString());
        }
    })
  </script>
@endscript
