<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        foreach ($roles as $role) {
            switch ($role) {
                case 'admin':
                    if (auth()->guard('admin')->check()) {
                        return $next($request);
                    }
                    break;
                case 'guru':
                    if (auth()->guard('guru')->check()) {
                        return $next($request);
                    }
                    break;
                case 'user':
                    if (auth()->guard('web')->check()) {
                        return $next($request);
                    }
                    break;
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
