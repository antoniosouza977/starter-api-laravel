<?php

namespace Database\Seeders\appends;

use App\Models\RestrictedRoute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestrictedRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonContent = file_get_contents(base_path('database/seeders/data/restricted_routes.json'));
        $routes = json_decode($jsonContent, true);

        DB::transaction(function () use ($routes) {
            foreach ($routes as $route) {
                RestrictedRoute::query()->updateOrCreate([
                    'name' => $route['name']
                ]);
            }
        });
    }
}
