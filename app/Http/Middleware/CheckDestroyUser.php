<?php

namespace App\Http\Middleware;

use App\Helpers\GetPermissionsHelper;
use Closure;

class CheckDestroyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $permissions = GetPermissionsHelper::getPermissions();

        if (in_array('destroy_user', $permissions))
            return $next($request);

        return redirect()->route('admin.users.home');
    }
}
