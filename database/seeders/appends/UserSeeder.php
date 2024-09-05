<?php

namespace Database\Seeders\appends;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()
            ->updateOrCreate([
                'name'     => 'Test User',
                'username' => 'testuser',
                'email'    => 'test@example.com',
            ], [
                'name'     => 'Test User',
                'username' => 'testuser',
                'email'    => 'test@example.com',
                'password' => Hash::make('password'),
            ]);
    }
}
