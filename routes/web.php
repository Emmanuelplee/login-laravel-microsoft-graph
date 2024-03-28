<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

// Route::group(['middleware' => ['web', 'MsGraphAuthenticated'], 'prefix' => 'app'], function(){
Route::group(['middleware' => ['web', 'MsGraphAuthenticated']], function(){
    Route::get('/home', [HomeController::class, 'welcome'])->name('app');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
