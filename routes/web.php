<?php

use App\Livewire\UsersController;
use App\Livewire\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Roles\RolesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Livewire\Assign\AssignByRolesController;
use App\Livewire\Assign\AssignByUsersController;
use App\Livewire\Permissions\PermissionsController;
use App\Livewire\ReportPermissions\ReportPermissionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', 'login');

Route::group(['middleware' => ['web', 'guest']], function(){
    Route::get('login', [AuthController::class,'login'])->name('login');
    Route::get('connect', [AuthController::class,'connect'])->name('connect');
});

// Solo usuarios autenticados en MSgraph
Route::group(['middleware' => ['web', 'MsGraphAuthenticated']], function(){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Route::get('/home', [HomeController::class, 'welcome'])->name('app');
    Route::get('/home',WelcomeController::class)->name('app');
    //              LIVEWIRE COMPONENTES
    // * =================================================================
    //              ADMINISTRACIÓN
    Route::get('/usuarios',UsersController::class);
    Route::get('/roles', RolesController::class);
    Route::get('/permisos',PermissionsController::class);
    Route::get('/reporte-permisos',ReportPermissionsController::class);
        //  =============================================================
        //              ASIGNAR PERMISOS
        Route::get('/asignar-por-rol',AssignByRolesController::class);
        Route::get('/asignar-por-usuario',AssignByUsersController::class);
});

// Route::view('test', 'welcome-test');
