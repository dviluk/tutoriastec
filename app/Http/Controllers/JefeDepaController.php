<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MyUser;

class JefeDepaController extends Controller
{
    public function alumnos() {
        //$users = MyUser::all();
        return view('jefedepa.alumnos');
    }
}
