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
</div>
