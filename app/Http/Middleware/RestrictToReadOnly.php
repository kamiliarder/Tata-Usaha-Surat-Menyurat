<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictToReadOnly
{
    /**
     * Handle an incoming request.
     * Restricts 'guru' role to read-only access (GET and HEAD requests only).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has 'guru' role
        if ($request->user() && $request->user()->role === 'guru') {
            // Check if the request method is not GET or HEAD (read-only methods)
            if (!$request->isMethod('get') && !$request->isMethod('head')) {
                // If it's an AJAX request, return JSON response
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Akses ditolak. Akun guru hanya memiliki akses baca.',
                        'error' => 'Forbidden'
                    ], 403);
                }

                // For regular requests, abort with 403 error
                abort(403, 'Akses ditolak. Akun guru hanya memiliki akses baca.');
            }
        }

        return $next($request);
    }
}
