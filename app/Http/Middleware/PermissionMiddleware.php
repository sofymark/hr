<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::user();
        if (strpos($permission, '.store') !== false || strpos($permission, '.update') !== false || strpos($permission, '.bulk') !== false|| strpos($permission, '.massstore') !== false|| strpos($permission, '.massupdate') !== false || strpos($permission, '.status') !== false || strpos($permission, '.search') !== false) {
            $permission = str_replace(array('.store', '.update', '.bulk', '.massstore', '.massupdate', '.status','.search'), array('.create', '.edit', '.edit', '.create', '.edit', '.edit','.index'), $permission);
        }
        if (!$user->getPermission($permission)) {
            return new RedirectResponse(url('/'));
        }
        return $next($request);
    }
}
