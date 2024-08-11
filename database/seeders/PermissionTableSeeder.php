<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'can create post',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'can view post',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'can edit post',
            'guard_name' => 'api',
        ]);
        DB::table('permissions')->insert([
            'name' => 'can delete post',
            'guard_name' => 'api',
        ]);

        $role = Role::where('name', 'SuperAdmin')->where('guard_name', 'api')->first();
        $create = Permission::where('name', 'can create post')->where('guard_name', 'api')->first();
        $edit = Permission::where('name', 'can edit post')->where('guard_name', 'api')->first();
        $delete = Permission::where('name', 'can delete post')->where('guard_name', 'api')->first();
        
        $role->givePermissionTo($create);
        $role->givePermissionTo($edit);
        $role->givePermissionTo($delete);
    }
}
