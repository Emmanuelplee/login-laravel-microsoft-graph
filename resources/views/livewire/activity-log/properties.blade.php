<div>
    @if (count($item->properties) > 0)

        <ul class="list-inline mb-0">
            {{-- @can('Roles_Show') --}}
                <li class="list-inline-item m-1">
                <a href="javascript:void(0)"
                    wire:click.prevent="$parent.propertiesShow({{ json_encode($item) }})"
                    wire:loading.class="loading-disabled"
                    class="avtar avtar-s btn btn-info"
                    style="width:30px; height:30px;">
                    <i class="ti ti-eye f-18"></i>
                </a>
                </li>
            {{-- @endcan --}}
            <li class="list-inline-item m-1">
                @if ($item->event === 'deleted')
                    # {{ isset($item->properties['old']) ? count($item->properties['old']) : 0}} campos
                @else
                    # {{ isset($item->properties['attributes']) ? count($item->properties['attributes']) : 0}} campos
                @endif
            </li>
        </ul>
    @else
        <span><strong>No tiene campos modificados.</strong></span>
    @endif
</div>
