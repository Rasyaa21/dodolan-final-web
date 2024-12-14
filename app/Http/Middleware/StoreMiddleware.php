<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $request->session()->regenerate();

        // Check if the session contains a valid store
        if (!$request->session()->has('store')) {
            return redirect()->route('login')->withErrors([
                'session' => 'Anda harus login terlebih dahulu.',
            ]);
        }

        $store = $request->session()->get('store');

        // Validate the store session data
        if (!$store || !isset($store->id)) {
            $request->session()->forget('store');
            return redirect()->route('login')->withErrors([
                'session' => 'Session tidak valid, silakan login kembali.',
            ]);
        }

        return $next($request);
    }
}
