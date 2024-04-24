<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Etiquetes meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content />
    <meta name="keywords" content>
    <meta name="author" content="Codedthemes" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.login.styles')

</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="row align-items-center text-center">
                    <div class="col-md-12">
                        <form method="POST" action="#">
                            <div class="card-body">
                                <img src="{{ asset('assets/images/logo-dark.png') }}" alt class="img-fluid mb-4">
                                <h6 class="mb-3 f-w-400">Inicia sesión con tu cuenta institucional</h4>
                                <!-- MARK: Campos del login -->
                                <a class="color-blanco btn btn-primary mt-2 mb-4"
                                    href="{{ route('connect')}}">
                                    Iniciar Sesión
                                </a>
                                <div class="text-end tooltip-login">
                                    <a href="https://mspv.servicecamp.com/portal/forms" class="text-primary" target="_blank" rel="noopener noreferrer">
                                        ¿Olvidaste tu contraseña?</a>
                                    <span class="tooltiptext">
                                        <i>Por favor genera un ticket solicitando el restablecimiento de su contraseña (clic para ir al formulario)</i>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('layouts.login.scripts')

</body>
</html>
