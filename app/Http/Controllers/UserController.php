<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MyUser;

class UserController extends Controller
{

	public function showLogin() {
		return view('login');
	}

	public function login(Request $request) {
		
		// Validate for input data
		$this->validate($request, MyUser::$login_validation_rules);
    	$data = $request->only('idUsu', 'UsuCon');

    	// Check if user exists
		$user = MyUser::where('idUsu', $data['idUsu'])->where('UsuCon', $data['UsuCon'])->first();  

		if($user) {
			if ($user->UsuTipo === 1) {
                session(['user' => $user]);
                return redirect()->action('AdminController@changeUser');
            }
            if ($user->UsuTipo === 2) {
                session(['user' => $user]);
                return redirect()->action('JefeDepaController@alumnos');
            }
		}

		// Get back to login with looser message
		return back()->withInput()->withErrors(['idUsu'=>'Usuario o contraseña inválidos']);
	}

	public function logout() {
		// Destroy global session and redirect to login
		session()->flush();
		return redirect('/');
	}
}