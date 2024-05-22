<div>
    <ul class="list-inline mb-0">
        <li class="list-inline-item m-1">
        <a href="javascript:void(0)"
            class="avtar avtar-s btn btn-info"
            style="width:30px; height:30px;">
            <i class="ti ti-eye f-18"></i>
        </a>
        </li>
        <li class="list-inline-item m-1">
        <a href="javascript:void(0)"
            {{-- wire:click.prevent="edit({{ $item->id }})" --}}
            class="avtar avtar-s btn btn-primary"
            style="width:30px; height:30px;">
            <i class="ti ti-pencil f-18"></i>
        </a>
        </li>
        <li class="list-inline-item m-1">
        <a href="javascript:void(0)"
            {{-- wire:click="$dispatch('Confirm',{ id: {{ $item->id }},eventName:'destroy',text:'¿ESTA SEGURO DE ELINIMAR EL REGISTRO?'})" --}}
            {{-- class="avtar avtar-s btn bg-white btn-link-danger"> --}}
            class="avtar avtar-s btn btn-danger"
            style="width:30px; height:30px;">
            <i class="ti ti-trash f-18"></i>
        </a>
        </li>
    </ul>
</div>
