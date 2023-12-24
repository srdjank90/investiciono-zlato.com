<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->input('token')) {
            return response(['error' => 'Token is missing'], 403);
        }

        if ($request->input('token') !== env('API_TOKEN', '1hbnPuxxKguJe7HlgIHhIBeWvoVGgJrh')) {
            return response(['error' => 'Token not is not valid'], 403);
        }

        return $next($request);
    }
}
