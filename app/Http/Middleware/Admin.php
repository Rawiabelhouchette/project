<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // return back if user is not authenticated or has no role (Professionnel or Administrateur)
        if (! auth()->user()->hasRole('Administrateur')) {
            // return back()->with('email', 'Vous n\'avez pas accès à cette page.');
            abort(404);
        }

        return $next($request);
    }
}
