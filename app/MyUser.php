<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyUser extends Model
{
    
    protected $table = 'tbl_usuarios';
    public $timestamps = false;
    
    public static $login_validation_rules = [
    'idUsu'=>'required|exists:tbl_usuarios', 
    'UsuCon'=>'required'
    ];

    public static $new_validation_rules = [
        'idUsu'=>'required',
        'UsuUsuario'=>'required',
        'UsuCon'=>'required',
        'UsuTipo'=>'required'
    ];
}
