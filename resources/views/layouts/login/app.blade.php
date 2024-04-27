<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Etiquetes meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Descripcion de la pagina">
    <meta name="keywords" content="Palabras clave">
    <meta name="author" content="manudev">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.login.styles')

</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            {{-- MARK:Login --}}
            @yield('content')
        </div>
    </div>

    @include('layouts.login.scripts')

</body>
</html>
