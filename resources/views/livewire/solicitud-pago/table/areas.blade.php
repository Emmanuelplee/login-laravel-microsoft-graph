<div class="row">
    <div class="col-md-5 d-flex align-items-center">
        {{-- wire:click.prevent="$parent.propertiesShow({{ json_encode($item) }})" --}}
        <button type="button"
            wire:click="apiActualizarRegistros({{ json_encode($correo) }})"
            wire:loading.attr="disabled"
            wire:target="apiActualizarRegistros"
            class="btn btn-primary btn-sm ms-2 mb-1">Actualizar sdps
        </button>
        {{-- <div class="text-info">
            <div class="spinner-border ms-2" role="status" wire:loading wire:target="apiActualizarRegistros"></div>
        </div> --}}
        {{-- <button
            wire:click.prevent="$dispatch('Revocar')"
            class="btn btn-primary btn-sm my-2 ms-1">Revocar Todos
        </button> --}}
    </div>
</div>
