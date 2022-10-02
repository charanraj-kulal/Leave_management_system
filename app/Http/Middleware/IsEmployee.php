<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class IsEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {   //Write the condition for Employee group
        if(auth()->user()->user_group_id == 3){
            
            return $next($request);
        }
       
    }
}
