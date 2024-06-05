<div>
    {{-- <span>{{ $item }}</span> --}}
    @php
        use App\Models\User;
        $userFind = User::find($item->id);

        $permissionsUsers = $userFind->getPermissionsViaRoles();// Objeto con collection de permissions
        $permissionsUsers = $userFind ? $permissionsUsers->pluck('name')->toArray() : [];
    @endphp
    {{-- <span> <strong>id:</strong>{{ $item->id }} <strong>id_user:</strong> {{ $user_id }}</span> --}}
    @if ($userFind && count($permissionsUsers) > 0)
        <ul class="list-group list-group-flush">
            @foreach ($permissionsUsers as $value)
                <li class="list-group-item">{{ $value }}</li>
            @endforeach
        </ul>
        {{-- <div><strong>El user es:</strong> {{ $userFind->name }}</div> --}}
        {{-- <div><strong>Permisos por usuario:</strong> {{ json_encode($permissionsUsers) }}</div> --}}
        {{-- <div><strong>Permisos por role:</strong> {{ json_encode($permissionsUsers) }}</div> --}}
    @else
        <span><strong>No tiene permisos asociados.</strong></span>
    @endif
</div>
