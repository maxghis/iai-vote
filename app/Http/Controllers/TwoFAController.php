<?php

namespace App\Http\Controllers;

use App\Models\UserCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TwoFAController extends Controller
{
    /**

     * Write code on Method

     *

     * @return response()

     */

     public function index()

     {
        if (intval((session('otp_code'))) == 0) {
            Session::put('otp_code', 1);
        }
 
 
         return view('2fa');
 
     }
 
   
 
     /**
 
      * Write code on Method
 
      *
 
      * @return response()
 
      */
 
     public function store(Request $request)
 
     {
        
 
         $request->validate([
 
             'code'=>'required',
 
         ]);
 
   
 
         $find = UserCode::where('user_id', auth()->user()->id)
 
                         ->where('code', $request->code)
 
                         ->where('updated_at', '>=', now()->subMinutes(2))
 
                         ->first();
 
   
 
         if (!is_null($find)) {
 
             Session::put('user_2fa', auth()->user()->id);
 
             return redirect()->route('index');
 
         }
 
   
 
         return back()->with('error', 'You entered wrong code.');
 
     }
 
     /**
 
      * Write code on Method
 
      *
 
      * @return response()
 
      */
 
     public function resend()
 
     {
        
        if(intval(session('otp_code')) <= 4){
            auth()->user()->generateCode();
            
         Session::put('otp_code', intval(session('otp_code')) + 1);
         return back()->with('success', 'Nous avons envoyer un code  par Email');


        } else {
            Auth::logout();
            Session::put('otp_code', 0);
            return redirect()->route('index');

        }
        
 
     }
}
