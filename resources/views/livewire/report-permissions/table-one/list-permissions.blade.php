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
        <ul class="list-inline mb-0">
            {{-- @can('Roles_Show') --}}
                <li class="list-inline-item m-1">
                <a href="javascript:void(0)"
                    wire:click.prevent="$parent.tableOneShow({{ $item->id }})"
                    wire:loading.class="loading-disabled"
                    class="avtar avtar-s btn btn-info"
                    style="width:30px; height:30px;">
                    <i class="ti ti-eye f-18"></i>
                </a>
                </li>
            {{-- @endcan --}}
            <li class="list-inline-item m-1">
                # {{ count($permissionsUsers) }}
            </li>
        </ul>
        {{-- <ul class="list-group list-group-flush">
            @foreach ($permissionsUsers as $value)
                <li class="list-group-item">{{ $value }}</li>
            @endforeach
        </ul> --}}
    @else
        <span><strong>No tiene permisos asociados.</strong></span>
    @endif
</div>
