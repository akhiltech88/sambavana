<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request){
        $username = $request->user_name;
        $password = $request->password;
        if (Auth::attempt(['user_name' => $username, 'password' => $password])) {
            $status = true;
            $code    = 200;
            $message = 'Login Success';
            $data = array( 
                    'access_token' => Auth::user()->api_token,
                    'name' => Auth::user()->user_name
                    );
            $response = array(
                'success' => $status,
                'code' => $code,
                'message' => $message,
                'data' => $data
            );
        return response($response, 200);

        }

    }
}
