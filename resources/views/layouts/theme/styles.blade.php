
<!-- [Favicon] icon -->
<link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
<!-- [Google Font : Poppins] icon -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
<link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">
<!-- [Mis Archivos CSS] -->
<link rel="stylesheet" href="{{ asset('assets/css/mis-css/settings.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/mis-css/nav-header.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/mis-css/formularios.css') }}">

<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/snackbar/snackbar.min.css')}}">
{{-- Livewire --}}
@livewireStyles

<style>
    /* sweetalerts 2 icons */
    .swal2-icon.swal2-warning {
      font-size: 18px !important;
    }
    .swal2-icon.swal2-info {
      font-size: 18px !important;
    }
    .swal2-popup .swal2-styled.swal2-cancel {
      color: #fff !important;
    }
    /* class laravel-livewire-table table */
    /* Asegúrate de que la tabla se desplace verticalmente */
    /* .table-responsive { */
    .table-responsive-sticky {
        height: 500px !important;
        overflow-y: auto !important;
    }

    /* Estilos para los encabezados fijos */
    .table-responsive-sticky table thead tr th {
        position: sticky !important;
        top: 0 !important;
        background: #DAF3F8 !important;
        z-index: 99 !important;
        box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4) !important;
    }
    table tbody {
        z-index: 1 !important;
    }

    /* Clase para desabilitar las etiquetas a con class loading-disabled */
    .loading-disabled {
        cursor: none !important;
        pointer-events: none !important;
        opacity: 0.5 !important;
    }

    {{-- *  Modal Sticky --}}
    .modal-content-sticky {
        height: 500px !important;
        overflow-y: auto !important;
    }
    /* Estilos para los encabezados fijos */
    .modal-content-sticky div p{
        position: sticky !important;
        top: 0 !important;
        background: #DAF3F8 !important;
        z-index: 99 !important;
        box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4) !important;
    }
</style>
