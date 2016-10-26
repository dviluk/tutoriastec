<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\MyUser;

class AdminController extends Controller
{

    public function changeUser() {
        return view('administrador.cambiarusuario');
    }

    public function users() {
        $users = MyUser::orderBy('UsuTipo')->where('UsuEstado', '=', '1')->get();
        return view('administrador.usuarios')->with('users', $users);
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
        $users = MyUser::orderBy('UsuTipo')->where('UsuEstado', '=', '1')->get();
        return $users;
    }

    public function addUser(Request $request) {
        $this->validate($request, MyUser::$new_validation_rules);
        $newUserData = $request->only('idUsu', 'UsuUsuario', 'UsuCon', 'UsuTipo');

        $tmp_user = MyUser::where('idUsu', '=', $newUserData['idUsu'])->first();
        if ($tmp_user) {
            return ['danger', "Ya existe un usuario con ese ide "];
        } else {
            $user = new MyUser();
            $user->idUsu = $newUserData['idUsu'];
            $user->UsuUsuario = $newUserData['UsuUsuario'];
            $user->UsuCon = $newUserData['UsuCon'];
            $user->UsuTipo = $newUserData['UsuTipo'];
            $user->UsuEstado = 1;
            $user->save();
        }
        return ['success', 'Usuario agregado correctamente.'];
    }

    public function editUser(Request $request) {
        $this->validate($request, MyUser::$new_validation_rules);
        //$newUserData = $request->only('idUsu', 'UsuUsuario', 'UsuCon', 'UsuTipo');

        if ($request->idUsu != 1000) {
            $result = DB::table('tbl_usuarios')
            ->where('idUsu', $request->idUsu)
            ->update(['UsuUsuario' => $request->UsuUsuario, 'UsuCon'=>$request->UsuCon, 'UsuTipo'=>$request->UsuTipo]);
            if ($result) {
                return ['success', 'Usuario modificado correctamente.'];
            }
        }
        return ['danger', 'Error al modificar el usuario'];
    }
    

    public function delUser(Request $request) {
        if ($request->idUsu != 1000) {
            $result = DB::table('tbl_usuarios')
            ->where('idUsu', $request->idUsu)
            ->update(['UsuEstado' => 0]);
            if ($result) {
                return ['success', 'Usuario eliminado correctamente.'];
            }
        }
        return ['danger', 'Error al intentar eliminar el usuario'];
    }
}
