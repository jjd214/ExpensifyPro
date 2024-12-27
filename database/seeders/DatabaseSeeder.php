<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::factory()->create([
            'name' => 'employee',
            'email' => 'employee@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'employee'
        ]);

        User::factory()->create([
            'name' => 'approver',
            'email' => 'approver@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'approver'
        ]);
    }
}
