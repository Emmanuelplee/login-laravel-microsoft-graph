@if ($status)
<span class="badge bg-success" style="opacity: 1">Si existen</span>
{{-- <span class="badge bg-light-success" style="opacity: 1">Activo</span> --}}
@else
    <span class="badge bg-danger" style="opacity: 1">No existen</span>
    {{-- <span class="badge bg-light-danger" style="opacity: 1">Inactivo</span> --}}
@endif
