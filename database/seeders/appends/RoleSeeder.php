<?php

namespace Database\Seeders\appends;

use App\Entities\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::beginTransaction();
        Role::query()->updateOrCreate([
            'id'   => 1,
            'name' => 'Manager'
        ]);
        DB::commit();


    }

}
