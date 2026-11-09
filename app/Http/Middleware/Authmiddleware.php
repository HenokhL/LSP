<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
 
class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (! session()->has('logged_in') || ! session('logged_in')) {
            return redirect()->route('auth.index')->with('error', 'Silakan login terlebih dahulu.');
        }
        return $next($request);
    }
}
 