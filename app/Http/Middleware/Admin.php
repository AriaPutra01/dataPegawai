<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class Admin
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

        if($userRole=='admin'){
            return $next($request);
        }

        if($userRole=='supervisor'){
            return redirect()->route('profileSupervisor.create');
        }

        if($userRole=='user'){
            return redirect()->route('profileUser.create');
        }
    }
}
