<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public static $login_validation_rules = [
    'email'=>'required|email|exists:users', 
    'password'=>'required'
    ];

    public static $new_validation_rules = [
        'idUsu'=>'required|exists:users',
        'UsuCon'=>'required'
    ];
}
