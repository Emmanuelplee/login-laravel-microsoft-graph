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
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/snackbar/snackbar.min.js') }}"></script>

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

@livewireScripts
{{-- Poner año actual en footer --}}
<script>document.getElementById("year").innerHTML = new Date().getFullYear();</script>

{{-- Notificacion global --}}
<script>
    function noty(msg, option = 1){
        Snackbar.show({
            text: msg.toUpperCase(),
            actionText: 'CERRAR',
            actionTextColor: '#ffff',
            backgroundColor: option == 1 ? '#38ba36' : '#c5444c',
            pos: 'top-right',
            duration: 10000,// 10 segundos
        });
    }
</script>

{{-- Aqui todos los scrips por @push()...@endpush --}}
@stack('js')
