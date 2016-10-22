<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{

	// Index
    public function changeuser () {
    	return view('administrador.cambiarusuario');
    }
	
	public function users() {
		return view('administrador.usuarios');
	}

	public function binnacle() {
		return view('administrador.bitacora');
	}
}
