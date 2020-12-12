<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CommonUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kingly Studio',
            'email' => 'user@user.com',
            'password' => Hash::make('secret'),
            'cpf' => '06985539009'
        ]);
    }
}
