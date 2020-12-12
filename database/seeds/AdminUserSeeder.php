<?php

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminProfile = Profile::findByName('Administrador');

        User::create([
            'name' => 'Kingly Studio',
            'email' => 'admin@admin.com',
            'password' => Hash::make('secret'),
            'cpf' => '91356959008',
            'profiles_id' => $adminProfile->id
        ]);
    }
}
