<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = 'username';

        //dd($this->username);
    }

    public function username()
    {
        return $this->username;
    }

     /**

     * Write code on Method

     *

     * @return response()

     */

     public function login(Request $request)

     {
 
         $request->validate([
 
             'username' => 'required',
             'password' => 'required',
             //'g-recaptcha-response' => 'required|captcha'
            
 
         ]);
 
      
 
         $credentials = $request->only('username', 'password');
 
      
         if (Auth::attempt(["username" => $credentials['username'], "password" => $credentials['password']])) {
 
   
 
             auth()->user()->generateCode();
 
   
 
             return redirect()->route('2fa.index');
 
         }
        
 
        return back()->withErrors(["username" => "Oppes! Vos informations ne sont pas corrects veuillez réessayer "]);
 
 
     }
}
