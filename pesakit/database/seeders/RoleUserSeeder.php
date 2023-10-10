<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Assign 'admin' role to a specific user (change user ID as needed)
        $adminUser = User::find(1);
        $adminRole = Role::where('name', 'admin')->first();
        $adminUser->roles()->attach($adminRole);

        // Assign 'user' role to other users
        $userRole = Role::where('name', 'user')->first();
        User::whereNotIn('id', [1])->each(function ($user) use ($userRole) {
            $user->roles()->attach($userRole);
        });
    }
}
