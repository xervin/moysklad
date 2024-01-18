<?php

namespace App\Http\Middleware;

use App\Services\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MSAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!User::isAuth()) {
            return redirect()->route('login');
        }

        if ($request->route()->getName() === 'login' && User::isAuth()) {
            return redirect()->route('index');
        }

        return $next($request);
    }
}
