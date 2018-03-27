<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//to manage api_token
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;


class ApiLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This is a custom login controller to handle login/logout requests for API.
    | It's similar to the default Auth LoginController although this one creates   
    | and destroy an api_token in the User model when login in and out and returns
    | a JSON response instead of a view.
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/tasks';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //override login method from trait
    public function login(Request $request){
      $this->validateLogin($request);
      
      if ($this->attemptLogin($request)) {
        $user = $this->guard()->user();
        //generate api_token
        $user->generateToken();

        return response()->json([
            'data' => $user->toArray(),
        ]);
      }

     return $this->sendFailedLoginResponse($request);
    }

    //override logout method from trait
    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();
        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json(['data' => 'User logged out.'], 200);
    } 
}
