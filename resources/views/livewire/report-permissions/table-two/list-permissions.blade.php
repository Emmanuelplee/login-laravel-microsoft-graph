<div>
    {{-- <span>{{ $item }}</span> --}}
    @php
        use App\Models\Role;
        $rolFind = Role::find($item->id);

        $permissions = $rolFind->permissions->pluck('name');// Objeto con collection de permissions
    @endphp
    {{-- <span> <strong>id:</strong>{{ $item->id }} <strong>id_user:</strong> {{ $user_id }}</span> --}}
    @if ($rolFind && count($permissions) > 0)

        <ul class="list-inline mb-0">
            {{-- @can('Roles_Show') --}}
                <li class="list-inline-item m-1">
                <a href="javascript:void(0)"
                    wire:click.prevent="$parent.tableTwoShow({{ $item->id }})"
                    wire:loading.class="loading-disabled"
                    class="avtar avtar-s btn btn-info"
                    style="width:30px; height:30px;">
                    <i class="ti ti-eye f-18"></i>
                </a>
                </li>
            {{-- @endcan --}}
            <li class="list-inline-item m-1">
                # {{ count($permissions) }}
            </li>
        </ul>
        {{-- <ul class="list-group list-group-flush">
            @foreach ($permissions as $value)
                <li class="list-group-item">{{ $value }}</li>
            @endforeach
        </ul> --}}
    @else
        <span><strong>No tiene permisos asociados.</strong></span>
    @endif
</div>
