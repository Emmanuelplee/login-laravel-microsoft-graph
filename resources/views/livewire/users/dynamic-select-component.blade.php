<div class="form-group">
    <label class="form-label">{{ $nameLabel }}</label>
    <select class="form-control"
        wire:model.live="selectedOption">
        <option value="ELEGIR" disabled>{{ $optionDefault }}</option>
        @foreach ($options as $option)
            <option value="{{ $option->id }}">{{ $option->name }}</option>
        @endforeach
    </select>
</div>
