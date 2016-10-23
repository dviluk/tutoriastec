<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\MyUser;

class AdminController extends Controller
{

    // Index
    public function changeUser()
    {
        return view('administrador.cambiarusuario');
    }

    public function users() {
        return view('administrador.usuarios');
    }

    public function binnacle()
    {
        $binnacle = DB::table('tlb_bitacora')
            ->join('tbl_usuarios', 'tlb_bitacora.idUsu', '=', 'tbl_usuarios.idUsu')
            ->select(DB::raw('tbl_usuarios.idUsu as id, UsuUsuario as usuario, accion, date(fecha) as fecha, time(fecha) as hora'))
            ->orderBy('fecha', 'hora')
            ->get();
        //$binnacle = print_r($binnacle);
        return view('administrador.bitacora')->with('binnacle', $binnacle);
    }

    public function showUsers() {
        $users = MyUser::orderBy('UsuTipo')->get();
        return $users;
    }

    /*public function addUser(Request $request) {
        $this->validate($request, MyUser::$new_validation_rules);
        $newUserData = $request->only('idUsu', 'UsuUsuario', 'UsuCon', 'UsuTipo');

        $user = new MyUser();
        $user->idUsu = $newUserData->idUsu;
        $user->UsuUsuario = $newUserData->UsuUsuario;
        $user->UsuCon = $newUserData->UsuCon;
        $user->UsuTipo = $newUserData->UsuTipo;
        $user->save();
        //return "Usuario creado correctamente";
        if ($request->ajax()) {
            return "hola";
        }return "adios";
    }*/
}
