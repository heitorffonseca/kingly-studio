<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return array
     */
    protected function getPermissions(): array
    {
        $permissions = [];

        $profile = Auth::user()->profile()->first();

        if (!is_null($profile))
            foreach ($profile->permissions()->get() as $permission)
                array_push($permissions, $permission->reference);

        return $permissions;
    }

    /**
     * @param String $string
     * @return string|string[]|null
     */
    protected function onlyNumbers(String $string)
    {
        return preg_replace('/[^0-9]/', '', $string);
    }
}
