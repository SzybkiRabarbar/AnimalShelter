<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'qwerty',
            'is_admin' => true,
            'uuid' => Str::uuid(),
        ]);

        // Create Normal User 1
        User::create([
            'name' => 'Normal User 1',
            'email' => 'user1@example.com',
            'password' => 'qwerty',
            'is_admin' => false,
            'uuid' => Str::uuid(),
        ]);

        // Create Normal User 2
        User::create([
            'name' => 'Normal User 2',
            'email' => 'user2@example.com',
            'password' => 'qwerty',
            'is_admin' => false,
            'uuid' => Str::uuid(),
        ]);
    }
}
