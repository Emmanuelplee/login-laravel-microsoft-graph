<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <script src="https://kit.fontawesome.com/2e0d547289.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    @include('layouts.login.styles')

    <!-- MARK:Styles -->
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <link href="https://getbootstrap.com/docs/5.0/examples/pricing/pricing.css" rel="stylesheet">

</head>
<body>

<div class="container py-3">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <i class="fa-solid fa-graduation-cap"></i> &nbsp;
                <span class="fs-4">Cursos</span>
            </a>

            <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-dark text-decoration-none" href="#">Rutas</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="#">Cursos</a>
                <a class="me-3 py-2 text-dark text-decoration-none" href="#">Precios</a>
                @auth
                    <p class="me-3 py-2">{{MsGraph::get('me')['displayName']}}</p>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="{{route('logout')}}">Cerrar Sesión</a>
                @else
                    <a class="py-2 text-dark text-decoration-none" href="{{ route('connect') }}">Iniciar Sesión</a>
                @endauth

            </nav>
        </div>

        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal">Precio</h1>
            @auth
                    <pre class="text-start" style="font-size: 1rem;">
                        {{print_r(MsGraph::get('me'))}}
                    </pre>
                    <pre>
                        {{ MsGraph::isConnected() ? 'Conectado' : 'No conectado' }}
                        {{ isset($token) ? $token : 'No hay token'}}
                    </pre>
                    {{-- <img src="{{ MsGraph::get('me')->photo()->content()->get()->wait(); }}" alt=""> --}}
            @endauth
            <p class="fs-5 text-muted">Accede a más de 300 cursos por 10$ mensuales y disfrut de clases en vivo y certificaciones de asistencias.</p>
        </div>
    </header>

    <main>
    </main>
</div>





</body>
</html>
