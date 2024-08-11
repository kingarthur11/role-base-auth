<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a user using Eloquent
        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password!1!2!3'),
        ]);

        // Seed multiple users using Eloquent factory
        User::factory()->count(10)->create();

        // Insert another user using the DB facade
        DB::table('users')->insert([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'password' => Hash::make('password!1!2!3'),
        ]);

        $user = User::where('email', 'john.doe@example.com')->first();
        $role = Role::where('name', 'SuperAdmin')->where('guard_name', 'api')->first();
        $user->assignRole($role);
    }
}
