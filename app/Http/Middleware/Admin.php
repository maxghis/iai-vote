<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!isset(auth()->user()->id)){
                
            return redirect()->route('index');   
                                      }
         else {
        
            if (auth()->user()->type == 3) {
                return $next($request);
            }
                                      
        if (auth()->user()->type == 1) {
            return $next($request);
        }
         
        }
        return redirect()->route('index'); 
    }
}
