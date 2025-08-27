<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Run AFTER the controller, so we can see session set by login.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Let the controller run first (so it can set session on successful login)
        $response = $next($request);

        // Only act if session('customer') is present
        $customer = session('customer');
        if (!$customer) {
            return $response; // login failed or not logged in; do nothing
        }

        // Redirect based on role
        if (($customer['role'] ?? null) === 'admin') {
            return redirect('/admin/dashboard');
        }

        if (($customer['role'] ?? null) === 'user') {
            return redirect('/user/dashboard');
        }

        // Unknown role → do nothing (or send to login/home if you prefer)
        return $response;
    }
}
