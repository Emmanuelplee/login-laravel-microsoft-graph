<div>
    {{-- {{ $item }} --}}
    @php
        use App\Models\User;
        // use Spatie\Permission\Models\Permission;
        // Encuentra el permiso
        // $permission = Permission::findByName($item->name);
        // Obtén todos los usuarios que tienen este permiso a través de roles
        $usersWithPermission = User::query()->with('roles:id,name')
        ->whereHas('roles.permissions', function ($query) use ($item) {
            $query->where('name', $item->name);
        })->get();
    @endphp
        {{-- <div><strong>user con permisos:</strong> {{ json_encode($usersWithPermission) }}</div> --}}
    @if ($item->name && count($usersWithPermission) > 0)
        <ul class="list-group list-group-flush">
            @foreach ($usersWithPermission as $value)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $value->alias }}
                    <span>{{ $value->roles[0]->name }}</span>
                </li>
                {{-- <li class="list-group-item">{{ $value->roles[0]->name }}</li> --}}
            @endforeach
        </ul>
    @else
        <span><strong>No tiene usuarios asociados.</strong></span>
    @endif
</div>
