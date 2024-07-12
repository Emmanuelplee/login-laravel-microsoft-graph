<div>
    {{-- <pre>{{ $item }}</pre> --}}
    <ul class="list-inline mb-0">
        {{-- @can('Roles_Show') --}}
            <li class="list-inline-item m-1">
                <a href="javascript:void(0)"
                    wire:click.prevent="$parent.show({{ $item->id }})"
                    wire:loading.class="loading-disabled"
                    class="avtar avtar-s btn btn-info"
                    style="width:30px; height:30px;">
                    <i class="ti ti-eye f-18"></i>
                </a>
            </li>
        {{-- @endcan --}}
        {{-- @can('Roles_Edit') --}}
            @if ($item->estatus !== 'SOLICITUD PAGADA' && $item->estatus !== 'SOLICITUD CANCELADA')
                <li class="list-inline-item m-1">
                    <a href="javascript:void(0)"
                        wire:click.prevent="$parent.edit({{ $item->id }})"
                        wire:loading.class="loading-disabled"
                        class="avtar avtar-s btn btn-primary"
                        style="width:30px; height:30px;">
                        <i class="ph ph-file-arrow-up f-18"></i>
                    </a>
                </li>
                <li class="list-inline-item m-1">
                    <a href="javascript:void(0)"
                        wire:click.prevent="apiActualizarPorFolio({{ json_encode($item->folio) }})"
                        wire:loading.class="loading-disabled"
                        wire:target="apiActualizarPorFolio"
                        class="avtar avtar-s btn btn-warning"
                        style="width:30px; height:30px;">
                        <i class="ph ph-arrows-clockwise f-18"></i>
                    </a>
                </li>
            @endif

        {{-- @endcan --}}
        {{-- @can('Roles_Delete')
            <li class="list-inline-item m-1">
            <a href="javascript:void(0)"
                wire:click.prevent="$dispatch('Confirm',{ id: {{ $item->id }},eventName:'destroy',text:'¿ESTA SEGURO DE ELINIMAR EL REGISTRO?'})"
                class="avtar avtar-s btn btn-danger"
                style="width:30px; height:30px;">
                <i class="ti ti-trash f-18"></i>
            </a>
            </li>
        @endcan --}}
    </ul>
</div>
