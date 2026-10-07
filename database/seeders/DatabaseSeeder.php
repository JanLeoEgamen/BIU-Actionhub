<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
        ]);

        $user = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => 'password',

        ]);

        $user->assignRole('Super Admin');
    }
}