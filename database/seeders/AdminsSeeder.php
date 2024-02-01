<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (DB::table('admins')->count() === 0) {
            $admins = [
                [
                    'id'   => 1,
                    'name' => 'admin',
                    'email' => 'admin@admin.com',
                    'email_verified_at' => null,
                    'password' => Hash::make('password'),
                    'remember_token' => null,
                    'created_at' => now(),
                    'updated_at' => now()
                ]

            ];
            DB::table('admins')->insert($admins);
            echo 'done';
        }
    }
}
