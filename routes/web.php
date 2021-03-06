<?php

Route::get('/', function () {
	if (session()->has('user')) {
		if (session('user')->UsuTipo == 1) {
			return redirect()->action('AdminController@changeUser');
		}
		if (session('user')->UsuTipo == 2) {
			return redirect()->action('JefeDepaController@alumnos');
		}
	} else {
    	return view('login');
	}
});
//Route::get('/', 'UserController@showLogin');
Route::post('login', 'UserController@login');
Route::get('destroy', 'UserController@logout');

// Administrador - vistas

Route::get('administrador', 'AdminController@changeUser');
Route::get('administrador/cambiarusuario', 'AdminController@changeUser');
Route::get('administrador/usuarios', 'AdminController@users');
Route::get('administrador/bitacora', 'AdminController@binnacle');
// Administrador - acciones
Route::get('administrador/verusuarios', 'AdminController@showUsers');
Route::post('administrador/agregarusuario', 'AdminController@addUser');
Route::put('administrador/editarusuario', 'AdminController@editUser');
Route::put('administrador/eliminarusuario', 'AdminController@delUser');


// Jefedepa - vistas
Route::get('jefedepa', 'JefeDepaController@alumnos');

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