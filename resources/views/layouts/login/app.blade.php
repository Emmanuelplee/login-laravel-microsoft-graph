<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Etiquetes meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content />
    <meta name="keywords" content>
    <meta name="author" content="Codedthemes" />


    @include('layouts.login.styles')

</head>
<body>
    {{-- Contenido principal --}}
    <div class="container">
        @yield('content')
    </div>

@include('layouts.login.scripts')

</body>
</html>
