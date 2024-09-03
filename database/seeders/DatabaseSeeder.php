<?php

namespace Database\Seeders;

use Database\Seeders\appends\RestrictedRouteSeeder;
use Database\Seeders\appends\RoleSeeder;
use Database\Seeders\appends\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            RestrictedRouteSeeder::class
        ]);

    }
}
