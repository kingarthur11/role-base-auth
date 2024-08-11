<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function handle(Request $request, Closure $next)
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->user()->roles->contains('name', $role)) {
            return response()->json(['data' => [], 'message' => "You are not authorised to access this page", 'status' => false], 403);
        }
        return $next($request);
    }
}
