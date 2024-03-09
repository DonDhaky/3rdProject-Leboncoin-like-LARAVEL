<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle($request, Closure $next)
    {
    // Vérifiez si l'utilisateur est un administrateur
    if (auth()->check() && auth()->user()->isAdmin()) {
        return $next($request);
    }

    // Erreur si l'user n'est pas un admin
    abort(403, 'Unauthorized');

    }
}
