<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSalesemployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {       //Write the condition for Manager group
        if(auth()->user()->user_group_id == 5){
            return $next($request);
        }
       
    }
}
