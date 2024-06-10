<div>
    {{-- {{ $item }} --}}
    @php
        use App\Models\User;
        // Obtén todos los usuarios que tienen este permiso a través de roles
        $usersWithPermission = User::query()->with('roles:id,name')
        ->whereHas('roles.permissions', function ($query) use ($item) {
            $query->where('name', $item->name);
        })->get();
    @endphp
        {{-- <div><strong>user con permisos:</strong> {{ json_encode($usersWithPermission) }}</div> --}}
    @if (count($usersWithPermission) > 0)

        <ul class="list-inline mb-0">
            {{-- @can('Roles_Show') --}}
                <li class="list-inline-item m-1">
                <a href="javascript:void(0)"
                    wire:click.prevent="$parent.tableFourShow({{ $item->id }})"
                    wire:loading.class="loading-disabled"
                    class="avtar avtar-s btn btn-info"
                    style="width:30px; height:30px;">
                    <i class="ti ti-eye f-18"></i>
                </a>
                </li>
            {{-- @endcan --}}
            <li class="list-inline-item m-1">
                # {{ count($usersWithPermission) }} usuarios
            </li>
        </ul>

        {{-- <ul class="list-group list-group-flush">
            @foreach ($usersWithPermission as $value)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $value->alias }}
                    <span>{{ $value->roles[0]->name }}</span>
                </li>
            @endforeach
        </ul> --}}
    @else
        <span><strong>No tiene usuarios asociados.</strong></span>
    @endif
</div>
