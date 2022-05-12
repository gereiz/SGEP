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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('/tutorial', ['as' => 'tutorial', 'uses' => 'HomeController@tutorial']);


/*PESSOAS*/

Route::prefix('pessoas')->group(function () {

route::get('/cadCliente', ['as' => 'cad.cliente', 'uses' => 'pessoas\ClienteController@index']);
route::post('/cadCliente', ['as' => 'cadastra.cliente', 'uses' => 'pessoas\ClienteController@cadastraCliente']);

});

Route::prefix('enderecos')->group(function () {

route::get('/gridCidades', ['as' => 'cad.cidades', 'uses' => 'Enderecos\CidadeController@index']);
route::post('/cadCidade', ['as' => 'cadastra.cidade', 'uses' => 'Enderecos\CidadeController@cadastraCidade']);
route::get('/cidadeForm', ['as' => 'form.cidade', 'uses' => 'Enderecos\CidadeController@dataForm']);
route::get('/editCidadeForm/{id}', ['as' => 'editForm.cidade', 'uses' => 'Enderecos\CidadeController@editDataForm']);
route::post('/delCidade/{id}', ['as' => 'deleta.cidade', 'uses' => 'Enderecos\CidadeController@delete']);

route::get('/gridRegioes', ['as' => 'cad.regioes', 'uses' => 'Enderecos\RegiaoController@index']);
route::post('/cadRegiao', ['as' => 'cadastra.regiao', 'uses' => 'Enderecos\RegiaoController@cadastraRegiao']);
route::get('/regiaoForm', ['as' => 'form.regiao', 'uses' => 'Enderecos\RegiaoController@dataForm']);
route::get('/editRegiaoForm/{id}', ['as' => 'editForm.regiao', 'uses' => 'Enderecos\RegiaoController@editDataForm']);
route::post('/delRegiao/{id}', ['as' => 'deleta.regiao', 'uses' => 'Enderecos\RegiaoController@delete']);

route::get('/gridBairros', ['as' => 'cad.bairros', 'uses' => 'Enderecos\BairroController@index']);
route::post('/cadBairro', ['as' => 'cadastra.bairro', 'uses' => 'Enderecos\BairroController@cadastraBairro']);
route::get('/bairroForm', ['as' => 'form.bairro', 'uses' => 'Enderecos\BairroController@dataForm']);
route::get('/editBairroForm/{id}', ['as' => 'editForm.bairro', 'uses' => 'Enderecos\BairroController@editDataForm']);
route::post('/delBairro/{id}', ['as' => 'deleta.bairro', 'uses' => 'Enderecos\BairroController@delete']);
    
});

Route::prefix('Outdoors')->group(function(){

route::get('/addOutdoor', ['as' => 'add_form_outdoor', 'uses' => 'Outdoors\OutdoorController@addForm']);
route::post('/insertOutdoor', ['as' => 'insert_outdoor', 'uses' => 'Outdoors\OutdoorController@store']);

route::get('/outdoorsGrid', ['as' => 'outdoor_grid', 'uses' => 'Outdoors\OutdoorController@index']);
route::post('/deleteOutdoor/{id}', ['as' => 'delete_outdoor', 'uses' => 'Outdoors\OutdoorController@deleteOutdoor']);

route::get('/editFormOutdoor/{id}', ['as' => 'edit_outdoor', 'uses' => 'Outdoors\OutdoorController@editForm']);
route::get('/viewFormOutdoor/{id}', ['as' => 'view_outdoor', 'uses' => 'Outdoors\OutdoorController@viewForm']);

});

Route::prefix('Reservas')->group(function () {

route::get('/gridBisemanas', ['as' => 'cad.bisemanas', 'uses' => 'Reservas\BisemanaController@index']);
route::post('/cadBisemana', ['as' => 'cadastra.bisemana', 'uses' => 'Reservas\BisemanaController@cadastraBisemana']);
route::get('/BisemanaForm', ['as' => 'form.bisemana', 'uses' => 'Reservas\BisemanaController@dataForm']);
route::post('/delBisemana/{id}', ['as' => 'deleta.bisemana', 'uses' => 'Reservas\BisemanaController@delete']);

route::get('/gridReservas', ['as' => 'cad.reservas', 'uses' => 'Reservas\ReservaController@index']);
route::post('/cadReserva', ['as' => 'cadastra.reserva', 'uses' => 'Reservas\ReservaController@cadastraReserva']);
route::get('/ReservaForm', ['as' => 'form.reserva', 'uses' => 'Reservas\ReservaController@dataForm']);
route::post('/delReserva/{id}', ['as' => 'deleta.reserva', 'uses' => 'Reservas\ReservaController@delete']);
    
});

Route::prefix('Mail')->group(function () {

route::get('/mailForm', ['as' => 'envio.email', 'uses' => 'mailController@index']);
route::post('/sendMail', ['as' => 'email', 'uses' => 'MailController@sendMail']);
    
});