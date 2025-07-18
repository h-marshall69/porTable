<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Verificar si el usuario tiene rol
                if (!$user->role) {
                    Auth::logout();
                    return redirect()->route('index')->withErrors([
                        'auth_error' => 'Tu cuenta no tiene rol asignado'
                    ]);
                }

                // Redirección segura
                return match($user->role->name) {
                    'Customer' => redirect()->intended(route('customer_home')),
                    'Admin' => redirect()->intended(route('admin_dashboard')),
                    'Restaurant' => redirect()->intended(route('restaurant_home')),
                    default => $this->handleInvalidRole($user)
                };
            }
        }

        return $next($request);
    }

    protected function handleInvalidRole($user): Response
    {
        Auth::logout();
        return redirect()->route('index')->withErrors([
            'auth_error' => 'Rol no reconocido: '.$user->role->name
        ]);
    }
}
