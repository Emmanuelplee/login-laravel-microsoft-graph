<div>
    <div class="form-group">
      <label>Para buscar Enter</label>
      <input class='form-control' type="text"
        wire:model="search"
        wire:keydown.enter="updateSearchPositions()"
        {{-- wire.change="updateSelectPositions" --}}
        placeholder="Buscar campo...">
      <select wire:model="selected"
        wire:change="searchOptions"
        class="form-control mb-3"
        id="selectPuestos">
        <option value="ELEGIR" disabled>Selecciona el campo</option>
        @foreach($filteredOptions  as $option)
          <option value="{{ $option->id }}">
            {{ $option->name }}
          </option>
        @endforeach
      </select>
      <p>campo seleccionado: {{ $selected }}</p>
    </div>
</div>
@script
  <script>
    Livewire.on('mount', function (value) {
      console.log('mount id:', value[0]);
    });
    Livewire.on('focusSelect', function () {
        document.getElementById('selectPuestos').focus();
        document.querySelector('select').click();
    });
  </script>
@endscript
