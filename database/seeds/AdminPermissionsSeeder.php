<?php

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Permission;

class AdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminProfile = Profile::findByName('Administrador');
        $permissions = Permission::all();


        foreach ($permissions as $permission)
            $permission->profiles()->attach($adminProfile->id);
    }
}
