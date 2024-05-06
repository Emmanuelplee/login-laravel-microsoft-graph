{{-- Scripts requeridos --}}
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/js/pcoded.js') }}"></script>
<script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>

<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/simple-datatables.js') }}"></script>

<script src="{{ asset('assets/js/plugins/bouncer.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-validation.js') }}"></script>

{{-- Funcionalidad de los Settings --}}
<script>layout_change('light');</script>
<script>layout_sidebar_change('light');</script>
<script>change_box_container('false');</script>
<script>layout_caption_change('false');</script> {{-- Info de los grupos sidebar--}}
<script>layout_rtl_change('false');</script>
<script>preset_change("preset-1");</script>
<script>header_change("header-1");</script>

{{-- Poner año actual en footer --}}
<script>document.getElementById("year").innerHTML = new Date().getFullYear();</script>

{{-- Tabla de vista usuarios --}}
<script>
  // Verificar si existe el elemento con ID #pc-dt-simple
  const dataTableElement = document.getElementById('pc-dt-simple');
  if (dataTableElement !== null) {
    // El elemento existe, haz algo con él
    console.log('dataTableElement existe.');
    // Por ejemplo, podrías hacer algo como esto:
    const dataTable = new simpleDatatables.DataTable("#pc-dt-simple", {
        sortable: false,
        searchable: true,
        perPage: 5
    });
  } else {
    // El elemento no existe
    console.log('dataTableElement no existe.');
  }
</script>
{{-- Aqui todos los scrips por la @push()...@endpush --}}
