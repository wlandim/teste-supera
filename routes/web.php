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
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {

    Route::redirect('/home', '/')->name('home');

    Route::get('empresas/search', 'EmpresaController@index')->name('empresas.search');

    Route::resource('empresas', 'EmpresaController');

    # UNIDADES
    Route::get('unidades/create/{empresa}', ['as' => 'unidades.create', 'uses' => 'UnidadeController@create']);
    Route::resource('unidades', 'UnidadeController')->except('create');

    # USUARIOS
    Route::get('usuarios/create/{empresa}', ['as' => 'usuarios.create', 'uses' => 'UsuarioController@create']);
    Route::resource('usuarios', 'UsuarioController')->except('create');

    # ATESTADOS
    Route::get('atestados/create/{unidade}', ['as' => 'atestados.create', 'uses' => 'AtestadoController@create']);
    Route::resource('atestados', 'AtestadoController')->except('create');

    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

