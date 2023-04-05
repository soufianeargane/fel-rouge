<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                // hashed password for 'password'
                'password' => Hash::make('password'),
                'role' => 2
            ],
            [
                'name' => 'owner',
                'email' => 'soufianeargane800@gmail.com',
                // hashed password for 'password'
                'password' => Hash::make('password'),
                'role' => 1
            ],
            [
                'name' => 'user',
                'email' => 'anovicsoso@gmail.com',
                // hashed password for 'password'
                'password' => Hash::make('password'),
                'role' => 0
            ],
        ];

        // Loop through each user data and create a user instance
        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'role' => $user['role']
            ]);
        }
    }
}