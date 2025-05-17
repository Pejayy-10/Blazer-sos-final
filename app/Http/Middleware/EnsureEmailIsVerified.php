<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if user is verified
        if (!Auth::user()->is_verified) {
            // Store user ID in session
            Session::put('auth.user_id', Auth::id());
            
            // Log user out
            Auth::logout();
            
            // Redirect to verification page
            return redirect()->route('verify.otp')
                ->with('message', 'Your email address is not verified. Please check your email for the verification code.');
        }

        return $next($request);
    }
} 