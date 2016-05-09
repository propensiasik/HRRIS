<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateWizard
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
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
            // if(isset($_SESSION['username']) && $_SESSION['username']!=''){
            // return $next($request);    
                return response('Unauthorized.', 401);
            }
            else{
                return redirect()->route('login');
            }
        }

        // buat GM
        if (orangnya = peasant || orangna=warrior) {
            // if ($request->ajax() || $request->wantsJson()) {
            // // if(isset($_SESSION['username']) && $_SESSION['username']!=''){
            // return $next($request);    
            //     //return response('Unauthorized.', 401);
            // }
            // else{
                return redirect()->route('home');
            }
        }
        
        return $next($request);
    }
}
