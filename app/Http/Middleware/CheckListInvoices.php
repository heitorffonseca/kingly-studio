<?php

namespace App\Http\Middleware;

use App\Helpers\GetPermissionsHelper;
use Closure;

class CheckListInvoices
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

        if (in_array('list_invoices', $permissions))
            return $next($request);

        return redirect()->route('admin.home');
    }
}
