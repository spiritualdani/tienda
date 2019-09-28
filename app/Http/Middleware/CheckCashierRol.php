<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class CheckCashierRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        $user=Auth::user(); 
        if($user->rol_id != 2) 
        {
            return redirect('home');

        }
        
        return $next($request);  // todo continua  
    
    }
}
