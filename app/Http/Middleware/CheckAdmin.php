<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        $user = Auth::user();
        $profile = $user->profile()->first();

        if (!is_null($profile)) {
            $permissions = $profile->permissions()->get();

            foreach ($permissions as $permission)
                if ($permission->reference == 'admin')
                    return $next($request);

        }

        return redirect()->route('dashboard');
    }
}
