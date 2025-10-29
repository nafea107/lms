<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Mohamed Nafea',
            'email' => 'admin@example.com',
            'country_phone_code' => '20',
            'phone' => '1026369598',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('admin');
    }
}
