<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


        if (DB::table('users')->count() === 0) {
            $users = [
                [
                    'id'   => 1,
                    'name' => 'user',
                    'email' => 'user@user.com',
                    'email_verified_at' => null,
                    'password' => Hash::make('password'),
                    'remember_token' => null,
                    'created_at' => now(),
                    'updated_at' => now()
                ]

            ];
            DB::table('users')->insert($users);
            echo 'done';
    }
}
}
