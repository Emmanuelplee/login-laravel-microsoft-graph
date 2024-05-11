
<div>
  <label class="form-label">{{ $nameLabel }}</label>
  <select class="form-control"
    id="{{ $this->idBox }}"
    name="{{ $this->idBox }}"
    wire:model.live="selectedOption">
    <option value="ELEGIR" disabled>{{ $optionDefault }}</option>
    @foreach ($options as $option)
      <option wire:key="{{ $option->id }}" value="{{ $option->id }}">{{ $option->name }}</option>
    @endforeach
  </select>
</div>
