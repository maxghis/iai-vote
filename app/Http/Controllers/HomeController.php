<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       if (isset(auth()->user()->type) AND auth()->user()->type == 1) {
        return redirect()->route('adminDashboard');
       }
       elseif (isset(auth()->user()->type) AND auth()->user()->type == 3) {
        return redirect()->route('adminDashboard');
      }
      elseif (isset(auth()->user()->type) AND auth()->user()->type == 2) {
        return redirect()->route('userVote');
      }
       else{
            return redirect()->route('login');
       }
    }
}
