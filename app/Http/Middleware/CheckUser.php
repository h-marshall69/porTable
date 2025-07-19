<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();

    // Carga explícita de la relación
    if (!$user->relationLoaded('role')) {
        $user->load('role');
    }

    // Verifica si la relación existe
    if (!$user->role) {
        abort(403, 'Usuario no tiene rol asignado');
    }

    if ($user->role->name != $role) {
        abort(403, 'Rol incorrecto para esta área');
    }

    if ($user->verified_at === null) {
        return redirect()->route('verification.notice');
    }

    return $next($request);
    }
}
