<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }
    protected function guard(){

        return Auth::guard('admin');
    }

    use AuthenticatesUsers;

    protected $redirectTo = '/admin';



    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.login');
    }

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
}
