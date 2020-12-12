<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckNoAdmin
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

        if (is_null($profile)) return $next($request);

        $permissions = $profile->permissions()->get();

        foreach ($permissions as $permission)
            if($permission->reference == 'admin') return redirect()->route('admin.home');

        return $next($request);
    }
}
