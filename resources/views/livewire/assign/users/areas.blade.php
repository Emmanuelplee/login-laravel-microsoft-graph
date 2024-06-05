<div class="row">
    <div class="col-md-3">
        <select
            id="id_user"
            wire:model="id_user"
            wire:change="builder()"
            class="form-control">
            <option value="ELEGIR" disabled>Selecciona un usuario</option>
            @foreach ($users as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-8">
        <button wire:click.prevent="syncAll()" type="button"
            class="btn btn-primary btn-sm my-2">Asignar Todos
        </button>
        <button
            wire:click.prevent="$dispatch('Revocar')"
            class="btn btn-primary btn-sm my-2 ms-1">Revocar Todos
        </button>
        <button
            {{-- wire:click.prevent="$dispatch('Revocar')" --}}
            class="btn btn-warning btn-sm my-2 ms-1">Restablecer
        </button>
    </div>
</div>
