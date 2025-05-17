<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin
        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@blazersos.com',
            'password' => Hash::make('SuperAdmin@2024'),
            'role' => 'super_admin',
            'email_verified_at' => now(),
        ]);

        // Create Normal Admin
        User::create([
            'first_name' => 'Normal',
            'last_name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@blazersos.com',
            'password' => Hash::make('Admin@2024'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
} 