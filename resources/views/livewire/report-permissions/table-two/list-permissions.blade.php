<div>
    {{-- <span>{{ $item }}</span> --}}
    @php
        use App\Models\Role;
        $rolFind = Role::find($item->id);

        $permissions = $rolFind->permissions->pluck('name');// Objeto con collection de permissions
    @endphp
    {{-- <span> <strong>id:</strong>{{ $item->id }} <strong>id_user:</strong> {{ $user_id }}</span> --}}
    @if ($rolFind && count($permissions) > 0)
        <ul class="list-group list-group-flush">
            @foreach ($permissions as $value)
                <li class="list-group-item">{{ $value }}</li>
            @endforeach
        </ul>
        {{-- <div><strong>El user es:</strong> {{ $rolFind->name }}</div> --}}
        {{-- <div><strong>Permisos por usuario:</strong> {{ json_encode($permissions) }}</div> --}}
        {{-- <div><strong>Permisos por role:</strong> {{ json_encode($permissions) }}</div> --}}
    @else
        <span><strong>No tiene permisos asociados.</strong></span>
    @endif
</div>
