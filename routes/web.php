<?php

use App\Livewire\UsersController;
use App\Livewire\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Roles\RolesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

// Solo usuarios autinticados en msgraph
Route::group(['middleware' => ['web', 'MsGraphAuthenticated']], function(){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    // Route::get('/home', [HomeController::class, 'welcome'])->name('app');
    // Livewire Components
    Route::get('/home',WelcomeController::class)->name('app');
    Route::get('/usuarios',UsersController::class);
    Route::get('/roles', RolesController::class);
    Route::get('/permisos',PermissionsController::class);
    Route::get('/reporte-permisos',ReportPermissionsController::class);
});

// Route::view('test', 'welcome-test');
