<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    protected $redirectTo = '/user';

    public function __construct()
    {
        $this->middleware('guest');
    }
    protected function guard()
    {
        return Auth::guard();
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),User::rules(), User::messages(), User::attributes());

        if ($validator->fails()) {
            return response()
                ->json(['StatusCode' => 3, 'StatusMessage' => $validator->messages()]);
        }
        $user = new User();

        $user->name = $request->input('name');
        $user->mobile_number = $request->input('phone_number');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        if ($user->save()){
            $this->guard()->login($user);
            return response()
                ->json(['StatusCode' => 1, 'StatusMessage' => 'ოპერაცია წარმატებით შესრულდა']);
        }

        return response()
            ->json(['StatusCode' => 0, 'StatusMessage' => 'დაფიქსირდა შეცდომა']);
    }
}
