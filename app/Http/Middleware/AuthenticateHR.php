<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateHR
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {    
       session_start();
        if (isset($_SESSION['email'])) {
            if ($_SESSION['booleanRole'] == 1||$_SESSION['booleanRole']== 2) {
                return redirect('Home');
            }
        }
        else{
            return redirect('/');
        }
        return $next($request);
    }
}
