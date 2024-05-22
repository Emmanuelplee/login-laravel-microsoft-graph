@if ($status)
<span class="badge bg-success" style="opacity: 1">Activo</span>
{{-- <span class="badge bg-light-success" style="opacity: 1">Activo</span> --}}
@else
    <span class="badge bg-danger" style="opacity: 1">Inactivo</span>
    {{-- <span class="badge bg-light-danger" style="opacity: 1">Inactivo</span> --}}
@endif
