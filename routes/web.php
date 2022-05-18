<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatilloController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::resource('platillo', PlatilloController::class)->middleware('auth'); //Aquí obtenemos todas las rutas: php artisan route:list

Auth::routes();

Route::get('/home', [PlatilloController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [PlatilloController::class, 'index'])->name('home');
});
