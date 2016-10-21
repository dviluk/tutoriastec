<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MyUser;

class AuthController extends Controller
{

	public function showLogin() {
		return view('login');
	}

	public function handleLogin(Request $request) {
		
		$this->validate($request, MyUser::$login_validation_rules);
    	$data = $request->only('idUsu', 'UsuCon');

		$user = MyUser::where('idUsu', $data['idUsu'])->where('UsuCon', $data['UsuCon'])->first();
		$types = array("","administrador","jefe-departamento","coordinador",
			"docente", "alumno", "subdirector","jefe-division",);
		$user->UsuTipo = $types[$user->UsuTipo];
		if($user) {
			return view('types.admin')->with('user', $user);
		} 
		
		return back()->withInput()->withErrors(['idUsu'=>'Usuario o contraseña inválidos'.$user]);
	}
}
