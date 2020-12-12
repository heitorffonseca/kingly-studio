<?php

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            ['name' => 'Usuário'],
            ['name' => 'Administrador']
        ];

        foreach ($profiles as $profile)
            Profile::create($profile);
    }
}
