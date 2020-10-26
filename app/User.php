<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'name','lastname','mobile_number', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function rules ($id = '') {
        return [
            'name'  => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|numeric|min:8',
            'lastname' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public static function attributes ($id = '') {
        return [
            'name'  => \Lang::get('global.name'),
            'email'     => \Lang::get('global.email'),
            'phone_number' => \Lang::get('global.phone'),
            'lastname' => \Lang::get('global.lastname'),
            'password' => \Lang::get('global.password'),
        ];
    }

    public static function messages ($id = '') {
        return [

        ];
    }
}
