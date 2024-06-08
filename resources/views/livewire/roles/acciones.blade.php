<div>
    {{-- <pre>{{ $item->id }}</pre> --}}
    <ul class="list-inline mb-0">
        @can('Roles_Show')
            <li class="list-inline-item m-1">
            <a href="javascript:void(0)"
                wire:click.prevent="$parent.show({{ $item->id }})"
                wire:loading.class="loading-disabled"
                class="avtar avtar-s btn btn-info"
                style="width:30px; height:30px;">
                <i class="ti ti-eye f-18"></i>
            </a>
            </li>
        @endcan
        @can('Roles_Edit')
            <li class="list-inline-item m-1">
            <a href="javascript:void(0)"
                wire:click.prevent="$parent.edit({{ $item->id }})"
                wire:loading.class="loading-disabled"
                class="avtar avtar-s btn btn-primary"
                style="width:30px; height:30px;">
                <i class="ti ti-pencil f-18"></i>
            </a>
            </li>
        @endcan
        @can('Roles_Delete')
            <li class="list-inline-item m-1">
            <a href="javascript:void(0)"
                wire:click.prevent="$dispatch('Confirm',{ id: {{ $item->id }},eventName:'destroy',text:'¿ESTA SEGURO DE ELINIMAR EL REGISTRO?'})"
                class="avtar avtar-s btn btn-danger"
                style="width:30px; height:30px;">
                <i class="ti ti-trash f-18"></i>
            </a>
            </li>
        @endcan
    </ul>
</div>
