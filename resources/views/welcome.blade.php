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

    <!-- // #region MARK:Styles -->
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

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
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
        {{-- <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Gratis</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>1 usuario</li>
                            <li>1 Curso al mes</li>
                            <li>Soporte por email</li>
                            <li>Comunidades</li>
                        </ul>
                        <button type="button" class="w-100 btn btn-lg btn-outline-primary">Iniciar Gratis</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Pago</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$15<small class="text-muted fw-light">/mo</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>2 Usuarios</li>
                            <li>+300 Cursos</li>
                            <li>Soporte por email + teléfono</li>
                            <li>Comunidades + Chat</li>
                        </ul>
                        <button type="button" class="w-100 btn btn-lg btn-primary">Iniciar</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm border-primary">
                    <div class="card-header py-3 text-white bg-primary border-primary">
                        <h4 class="my-0 fw-normal">Empresas</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">$29<small class="text-muted fw-light">/mo</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Todo lo del plan Pago</li>
                            <li>Tutores</li>
                            <li>Soporte Prioritario 24/7</li>
                            <li>Acceso a Simuladores</li>
                        </ul>
                        <button type="button" class="w-100 btn btn-lg btn-primary">Contactanos</button>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <h2 class="display-6 text-center mb-4">Comparar planes</h2>

        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                <tr>
                    <th style="width: 34%;"></th>
                    <th style="width: 22%;">Gratis</th>
                    <th style="width: 22%;">Pago</th>
                    <th style="width: 22%;">Empresas</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row" class="text-start">Public</th>
                    <td><i class="fa-solid fa-check"></i></td>
                    <td><i class="fa-solid fa-check"></i></td>
                    <td><i class="fa-solid fa-check"></i></td>
                </tr>
                <tr>
                    <th scope="row" class="text-start">Private</th>
                    <td></td>
                    <td><i class="fa-solid fa-check"></i></td>
                    <td><i class="fa-solid fa-check"></i></td>
                </tr>
                </tbody>

                <tbody>
                <tr>
                    <th scope="row" class="text-start">Permissions</th>
                    <td><i class="fa-solid fa-check"></i></td>
                    <td><i class="fa-solid fa-check"></i></td>
                    <td><i class="fa-solid fa-check"></i></td>
                </tr>
                <tr>
                    <th scope="row" class="text-start">Sharing</th>
                    <td></td>
                    <td><i class="fa-solid fa-check"></i></td>
                    <td><i class="fa-solid fa-check"></i></td>
                </tr>
                <tr>
                    <th scope="row" class="text-start">Unlimited members</th>
                    <td></td>
                    <td><i class="fa-solid fa-check"></i></td>
                    <td><i class="fa-solid fa-check"></i></td>
                </tr>
                <tr>
                    <th scope="row" class="text-start">Extra security</th>
                    <td></td>
                    <td></td>
                    <td><i class="fa-solid fa-check"></i></td>
                </tr>
                </tbody>
            </table>
        </div> --}}
    </main>

    {{-- <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <i class="fa-solid fa-graduation-cap"></i> &nbsp;
                <small class="d-block mb-3 text-muted">© 2022–2023</small>
            </div>
            <div class="col-6 col-md">
                <h5>Caracteristicas</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum developers</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Recursos</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Información</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Lorem Ipsum</a></li>
                </ul>
            </div>
        </div>
    </footer> --}}
</div>





</body>
</html>
