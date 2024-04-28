<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Descripcion de la pagina">
    <meta name="keywords" content="Palabras clave">
    <meta name="author" content="manudev">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- MARK:[Archivos CSS] -->
    @include('layouts.theme.styles')

</head>
<!-- [Body] Start -->
<body data-pc-header="header-1" data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true"
    data-pc-direction="ltr" data-pc-theme="light">
    <!-- [Pre-loader] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [Pre-loader] End -->
    <!-- [sidebar Movil] [navbar] start -->
    @include('layouts.theme.sidebar_navbar')
    <!-- [sidebar Movil] [navbar] end -->
    <!-- [Header Topbar ] start -->
    @include('layouts.theme.header')
    <!-- [ Header ] end -->

    <!-- MARK:[MainContent] start -->
    <div class="pc-container">
        @yield('content')
    </div>
    <!-- [MainContent] end -->

    <!-- [ Footer ] start -->
    @include('layouts.theme.footer')
    <!-- [ Footer ] end -->
    <!-- MARK:[Scripts] start-->
    @include('layouts.theme.scripts')
    <!-- [Scripts] end-->
    <!-- [Settings] start-->
    @include('layouts.theme.settings')
    <!-- [Settings] end-->

</body>
<!-- [Body] end -->
</html>
