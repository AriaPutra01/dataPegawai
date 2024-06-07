<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class Supervisor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }
        $userRole=Auth::user()->role;

        if($userRole=='supervisor'){
            return $next($request);
        }

        if($userRole=='admin'){
            return redirect()->route('profileAdmin.create');
        }

        if($userRole=='user'){
            return redirect()->route('profileUser.create');
        }
    }
}
