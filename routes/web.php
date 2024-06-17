<?php

use App\Livewire\UsersController;
use App\Livewire\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Roles\RolesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Livewire\Assign\AssignByRolesController;
use App\Livewire\Assign\AssignByUsersController;
use App\Livewire\ActivityLog\ActivityLogController;
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
    // Route::get('/home', [HomeController::class, 'welcome'])->name('app'); // Anterior
    Route::get('/home',WelcomeController::class)->name('app');
    //              LIVEWIRE COMPONENTES
    // * =================================================================
    //              DESARROLLADOR
    Route::group(['middleware' => ['role:Desarrollador']], function () {
        Route::get('/permisos',PermissionsController::class);
    });
    // * =================================================================
    //              ADMINISTRACIÓN
    Route::group(['middleware' => ['role:Desarrollador|Administrador']], function () {
        //  =============================================================
        //              ASIGNAR PERMISOS
        Route::get('/asignar-por-rol',AssignByRolesController::class)->middleware('permission:Assign_Index');
        // Route::get('/asignar-por-usuario',AssignByUsersController::class);
    });
    Route::get('/usuarios',UsersController::class)->middleware('permission:Users_Index');
    Route::get('/roles', RolesController::class)->middleware('permission:Roles_Index');
    Route::get('/reporte-permisos',ReportPermissionsController::class)->middleware('permission:Report_Permissions_Index');
    Route::get('/registro-actividades',ActivityLogController::class);
});

// Route::view('test', 'welcome-test');
