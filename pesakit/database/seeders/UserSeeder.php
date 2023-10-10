<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'name' => 'admin',
            'email'=> 'admin@admin.com',
            'phone'=> '0707282965',
            'password'=>'admin' //have used $protected casts to hash the password

        ];
        $user = [
            'name' => 'user',
            'email'=> 'user@user.com',
            'phone'=> '0707282965',
            'password'=>'user'//have used $protected casts to hash the password

        ];

        User::create($admin);
        User::create($user);
    }
}
