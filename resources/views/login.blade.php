@extends('layouts.login.app')

{{-- MARK:Login --}}
@section('content')
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
                                <i>Por favor genera un ticket solicitando el restablecimiento de su contraseña (clic para ir al formulario)</i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

