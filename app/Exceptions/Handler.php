<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

    }

    public function render($request, Throwable $exception)
    {
        //error 404 la url no existe
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $message = 'La pagina no fue encontrada o no existe.';
            $status  = 404;
            return response()->view('error.errors',['message' => $message,'status'=>$status]);
        }

        //error 403 no tienes autorización
        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            $message = 'No tienes la autorización requerida.';
            $status  = 403;
            return response()->view('error.errors',['message' => $message,'status'=>$status]);
        }
        //error 419 entra pagina expirada
        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            $message = 'La Pagina ha expirado.';
            $status  = 419;
            return response()->view('error.errors',['message' => $message,'status'=>$status]);
            // return redirect()->route('login');
        }
        //error 417 error obtener token valido
        if ($exception instanceof \League\OAuth2\Client\Provider\Exception\IdentityProviderException) {
            $message = 'Error al obtener un token valido.';
            $status  = 417;
            return response()->view('error.errors',['message' => $message,'status'=>$status]);
            // return redirect()->route('login');
        }
        //Erro 504 no existe la ruta
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $message = 'La pagina no fue encontrada o no existe.';
            $status  = 504;
            return response()->view('error.errors',['message' => $message,'status'=>$status]);
            // return redirect('/pos');
        }
        return parent::render($request, $exception);
    }
}
