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

route::get('/gridCidades', ['as' => 'cad.cidades', 'uses' => 'enderecos\CidadeController@index']);
route::post('/cadCidade', ['as' => 'cadastra.cidade', 'uses' => 'enderecos\CidadeController@cadastraCidade']);
route::get('/cidadeForm', ['as' => 'form.cidade', 'uses' => 'enderecos\CidadeController@dataForm']);
route::get('/editCidadeForm/{id}', ['as' => 'editForm.cidade', 'uses' => 'enderecos\CidadeController@editDataForm']);
route::post('/delCidade/{id}', ['as' => 'deleta.cidade', 'uses' => 'enderecos\CidadeController@delete']);

route::get('/gridRegioes', ['as' => 'cad.regioes', 'uses' => 'enderecos\RegiaoController@index']);
route::post('/cadRegiao', ['as' => 'cadastra.regiao', 'uses' => 'enderecos\RegiaoController@cadastraRegiao']);
route::get('/regiaoForm', ['as' => 'form.regiao', 'uses' => 'enderecos\RegiaoController@dataForm']);
route::get('/editRegiaoForm/{id}', ['as' => 'editForm.regiao', 'uses' => 'enderecos\RegiaoController@editDataForm']);
route::post('/delRegiao/{id}', ['as' => 'deleta.regiao', 'uses' => 'enderecos\RegiaoController@delete']);

route::get('/gridBairros', ['as' => 'cad.bairros', 'uses' => 'enderecos\BairroController@index']);
route::post('/cadBairro', ['as' => 'cadastra.bairro', 'uses' => 'enderecos\BairroController@cadastraBairro']);
route::get('/bairroForm', ['as' => 'form.bairro', 'uses' => 'enderecos\BairroController@dataForm']);
route::get('/editBairroForm/{id}', ['as' => 'editForm.bairro', 'uses' => 'enderecos\BairroController@editDataForm']);
route::post('/delBairro/{id}', ['as' => 'deleta.bairro', 'uses' => 'enderecos\BairroController@delete']);
    
});

Route::prefix('Outdoors')->group(function(){

route::get('/addOutdoor', ['as' => 'add_form_outdoor', 'uses' => 'Outdoors\OutdoorController@addForm']);
route::post('/insertOutdoor', ['as' => 'insert_outdoor', 'uses' => 'Outdoors\OutdoorController@store']);

route::get('/outdoorsGrid', ['as' => 'outdoor_grid', 'uses' => 'Outdoors\OutdoorController@index']);
route::post('/deleteOutdoor/{id}', ['as' => 'delete_outdoor', 'uses' => 'Outdoors\OutdoorController@deleteOutdoor']);

route::get('/editFormOutdoor/{id}', ['as' => 'edit_outdoor', 'uses' => 'Outdoors\OutdoorController@editForm']);
route::get('/viewFormOutdoor/{id}', ['as' => 'view_outdoor', 'uses' => 'Outdoors\OutdoorController@viewForm']);

});