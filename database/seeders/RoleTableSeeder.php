<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'SuperAdmin',
            'guard_name' => 'api',
        ]);

        DB::table('roles')->insert([
            'name' => 'Admin',
            'guard_name' => 'api',
        ]);
        
        DB::table('roles')->insert([
            'name' => 'User',
            'guard_name' => 'api',
        ]);
    }
}
