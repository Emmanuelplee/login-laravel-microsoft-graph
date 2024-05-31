<div>
    <div class="form-check form-switch">
        @php
            use App\Models\Role;
            if ($role != 'ELEGIR') {
                $r = Role::find($role);
                // Verificando si el rol tiene un permiso específico
                $permiso = $item->name; // permiso que deseas verificar
                $tienePermiso = $r ? $r->hasPermissionTo($permiso) : false;
                if ($tienePermiso) {
                    $item->checked = 1;
                }
            }
        @endphp
        {{-- <span> <strong>id:</strong>{{ $item->id }} <strong>id_role:</strong> {{ $role }}</span>
        @if ($r)
            <span><strong>El rol es:</strong> {{ $r->name }}</span>
        @else
            <span><strong>No hay rol.</strong></span>
        @endif --}}
        <input type="checkbox"
            id="p{{$item->id}}"
            wire:change="syncPermiso($('#p'+{{$item->id}}).is(':checked'),'{{$item->name}}')"
            value="{{$item->id}}"
            class="form-check-input input-success f-16"
            {{ $item->checked == 1 ? 'checked' : ''}}>
    </div>
    {{-- <ul class="list-inline mb-0">
        <li class="list-inline-item m-1">
        <a href="javascript:void(0)"
            wire:click.prevent="$parent.show({{ $item->id }})"
            class="avtar avtar-s btn btn-info"
            style="width:30px; height:30px;">
            <i class="ti ti-eye f-18"></i>
        </a>
        </li>
        <li class="list-inline-item m-1">
        <a href="javascript:void(0)"
            wire:click.prevent="$parent.edit({{ $item->id }})"
            class="avtar avtar-s btn btn-primary"
            style="width:30px; height:30px;">
            <i class="ti ti-pencil f-18"></i>
        </a>
        </li>
        <li class="list-inline-item m-1">
        <a href="javascript:void(0)"
            wire:click.prevent="$dispatch('Confirm',{ id: {{ $item->id }},eventName:'destroy',text:'¿ESTA SEGURO DE ELINIMAR EL REGISTRO?'})"
            class="avtar avtar-s btn btn-danger"
            style="width:30px; height:30px;">
            <i class="ti ti-trash f-18"></i>
        </a>
        </li>
    </ul> --}}
</div>
