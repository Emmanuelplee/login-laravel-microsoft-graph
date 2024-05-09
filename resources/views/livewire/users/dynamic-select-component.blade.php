
<div>
  <label class="form-label">{{ $nameLabel }}</label>
  <select class="form-control"
    id="{{ $this->idBox }}"
    wire:model.live="selectedOption">
    <option value="ELEGIR" selected>{{ $optionDefault }}</option>
    @foreach ($options as $option)
      <option value="{{ $option->id }}">{{ $option->name }}</option>
    @endforeach
  </select>
</div>
