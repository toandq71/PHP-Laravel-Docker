<?php

namespace App\Http\Middleware;

use App\Enums\EGuardNameEnum;
use App\Enums\EPermissionNameEnum;
use Closure;

class CheckRoutePermissionAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user(EGuardNameEnum::ADMIN);

        if ($user->can(EPermissionNameEnum::parsePermission($request->route()->getName()))) {
            return $next($request);
        }

        abort(403, 'Forbidden to access! Please contact to admin.');
    }
}
