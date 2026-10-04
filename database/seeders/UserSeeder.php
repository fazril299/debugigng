<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);

        User::create([
            'name' => 'User Demo',
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);
    }
}
