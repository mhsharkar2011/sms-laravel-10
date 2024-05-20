<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ParentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 4 && Auth::user()->is_deleted == 0) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect(url(''))->with('error','Your account has been deleted to active your account please contact with admin or register a new account');
            }
        } else {
            Auth::logout();
            return redirect(url(''));
        }
    }
}
