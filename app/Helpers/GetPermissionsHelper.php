<?php


namespace App\Helpers;


use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class GetPermissionsHelper
{
    public static function getPermissions()
    {
        $permissions = [];

        $profile = Auth::user()->profile()->first();

        if (!is_null($profile))
            foreach ($profile->permissions()->get() as $permission)
                array_push($permissions, $permission->reference);

        return $permissions;
    }

    public static function getPermissionsToProfile(Profile $profile)
    {
        $permissions = [];

        if (!is_null($profile))
            foreach ($profile->permissions as $permission)
                array_push($permissions, $permission->reference);

        return $permissions;
    }
}
