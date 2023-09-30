<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::user()->role_id === 1);
        if (Auth::user() &&  Auth::user()->role_id == RoleEnum::ADMIN->value) {
            return $next($request);
        }
        Auth::logout();
        return to_route('login')
            ->with('error', 'You can\'t perform this action.');
    }
}
