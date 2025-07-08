<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->to('/auth?o=login')
                ->with('error', 'Kamu harus login terlebih dahulu.');
        }

        $user = auth()->user();

        foreach ($roles as $role) {
            if ($user->role->value !== $role) {
                return redirect()->route('home')
                    ->with('error', 'Kamu tidak memiliki akses ke halaman ini.');
            }
        }

        return $next($request);
    }
}
