<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create or update admin user
        $admin = User::updateOrCreate(
            ['username' => 'admin'],
            [
                'username' => 'admin',
                'email' => 'admin@artsofcode.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        if ($admin->wasRecentlyCreated) {
            $this->command->info('Admin user created successfully!');
        } else {
            $this->command->info('Admin user already exists, updated!');
        }

        $this->command->info('Username: admin');
        $this->command->info('Email: admin@artsofcode.com');
        $this->command->info('Password: admin123');
    }
}