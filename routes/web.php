<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tutorial', ['as' => 'tutorial', 'uses' => 'HomeController@tutorial']);


/*PESSOAS*/

Route::prefix('pessoas')->group(function () {

route::get('/cadCliente', ['as' => 'cad.cliente', 'uses' => 'pessoas\ClienteController@index']);

route::post('/cadCliente', ['as' => 'cadastra.cliente', 'uses' => 'pessoas\ClienteController@cadastraCliente']);

});