<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

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

/*Route::get('/empleado', function () {
    return view('empleado.index');
});*/
//Route::get('/empleado/index',[EmpleadoController::class,'index']);

Route::resource('empleado', EmpleadoController::class)->middleware('auth');
Auth::routes(['register'=>false,'reset'=>false]);// añade todas las rutas de autenticación

Route::get('/inicio', [EmpleadoController::class, 'index'])->name('inicio');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/',[EmpleadoController::class,'index'])->name('inicio');
});
