<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            $this->username() => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()
                ->json(['StatusCode' => 3,
                    'StatusMessage' => $validator->messages()]);
        }

        if ($this->attemptLogin($request)) {
            return response()
                ->json(['StatusCode' => 1,
                    'StatusMessage' => 'ოპერაცია წარმატებით შესრულდა!!']);
        }
        return response()
            ->json(['StatusCode' => 0,
                'StatusMessage' => 'მონაცემები არასწორია!']);
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
