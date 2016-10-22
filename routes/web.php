<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', function () {
	if (session()->has('user')) {
		if (session('user')->UsuTipo == 1) {
			return redirect()->action('AdminController@changeuser');
		}
	} else {
    	return view('login');
	}
});
//Route::get('/', 'UserController@showLogin');
Route::post('login', 'UserController@login');
Route::get('destroyAllHumans', 'UserController@logout');

Route::get('administrador', 'AdminController@changeuser');
Route::get('administrador/cambiarusuario', 'AdminController@changeuser');
Route::get('administrador/usuarios', 'AdminController@users');
Route::get('administrador/bitacora', 'AdminController@binnacle');


