<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MyUser;

class UserController extends Controller
{

	public function showLogin() {
		return view('login');
	}

	public function login(Request $request) {
		
		$this->validate($request, MyUser::$login_validation_rules);
    	$data = $request->only('idUsu', 'UsuCon');

		$user = MyUser::where('idUsu', $data['idUsu'])->where('UsuCon', $data['UsuCon'])->first();  

		if($user) {
			if ($user->UsuTipo === 1) {
				session(['user' => $user]);
				return redirect()->action('AdminController@changeuser');
			}
		} 
		return back()->withInput()->withErrors(['idUsu'=>'Usuario o contraseña inválidos']);
	}

	public function logout() {
		session()->flush();
		return redirect('/');
	}
}