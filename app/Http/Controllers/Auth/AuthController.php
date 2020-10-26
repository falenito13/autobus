<?php

namespace App\Http\Controllers\Auth;

use App\Meta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
    public function index(){
        return View('auth.login');
    }
    public function history(){
        $Route = Route::getCurrentRoute()->getName();
        $meta = Meta::where('type_id','=','10')->first();
        return View('auth.history', ['Route' => $Route, 'Meta' => $meta]);
    }
}
