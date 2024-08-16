<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminCommonGetPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->exists('account_management') || session()->exists('teacher_account') || session()->exists('student_management') || session()->exists('super_admin') || session()->exists('school_management')) {
            // Allow access to the route
        } else {
            return redirect('/account-login');
        }

        return $next($request);
    }
}
