<div>
    <div class="form-check form-switch">
        @php
            $userFind = [];
            use App\Models\User;

            if ($user_id != 'ELEGIR') {
                $userFind = User::find($user_id);
                // Verificando si el usuario tiene un permiso específico
                $permiso = $item->name; // permiso que deseas verificar
                $tienePermiso = $userFind ? $userFind->hasPermissionTo($permiso) : false;
                if ($tienePermiso) {
                    $item->checked = 1;
                }
                $permissionsUsers = $userFind->getPermissionNames(); // collection of name strings
                // dump($permissionNames);
                $permissionsRoles = $userFind->getPermissionsViaRoles();// Objeto con collection de permissions
                $permissionsRoles = $userFind ? $permissionsRoles->pluck('name')->toArray() : [];
            }
        @endphp
        <span> <strong>id:</strong>{{ $item->id }} <strong>id_user:</strong> {{ $user_id }}</span>
        @if ($userFind)
            <div><strong>El user es:</strong> {{ $userFind->name }}</div>
            <div><strong>Permisos por usuario:</strong> {{ json_encode($permissionsUsers) }}</div>
            <div><strong>Permisos por role:</strong> {{ json_encode($permissionsRoles) }}</div>
        @else
            <span><strong>No hay rol.</strong></span>
        @endif
        <input type="checkbox"
            id="p{{$item->id}}"
            wire:change="syncPermiso($('#p'+{{$item->id}}).is(':checked'),'{{$item->name}}')"
            value="{{$item->id}}"
            class="form-check-input input-success f-16"
            {{ $item->checked == 1 ? 'checked' : ''}}>
    </div>
</div>
