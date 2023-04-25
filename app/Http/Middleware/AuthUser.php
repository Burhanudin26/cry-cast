<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (Auth::check()) {
            $verified = $request->session()->get('verified');
            if ($verified) {
                // User is verified, proceed with request
                return $next($request);
            }
        }

        // User is not authenticated or not verified, redirect to login page
        return redirect('/loginPage')->withErrors([
            'notVerified' => 'Please Verify Your Account First',
        ]);
    }
}
