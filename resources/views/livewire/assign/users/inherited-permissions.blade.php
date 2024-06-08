<div>
    <div class="form-check form-switch">
        @php
            use App\Models\User;
            $userFind = [];
            if ($user_id != 'ELEGIR') {
                $userFind = User::find($user_id);
                // Verificando si el rol tiene un permiso específico
                $permiso = $item->name; // permiso que deseas verificar
                $tienePermiso = $userFind ? $userFind->hasPermissionTo($permiso) : false;
                // if ($tienePermiso) {
                //     $item->checked = 1;
                // }
            }
        @endphp
        {{-- <span> <strong>id:</strong>{{ $item->id }} <strong>id_role:</strong> {{ $role }}</span>
        @if ($r)
            <span><strong>El rol es:</strong> {{ $r->name }}</span>
        @else
            <span><strong>No hay rol.</strong></span>
        @endif --}}

        {{-- @if ($status)
            <span class="badge bg-success" style="opacity: 1">Activo</span>
        @else
            <span class="badge bg-danger" style="opacity: 1">Inactivo</span>
        @endif --}}
        <input type="checkbox"
            class="form-check-input input-success f-16"
            {{ $item->checked == 1 ? 'checked' : ''}} disabled>
    </div>
</div>
