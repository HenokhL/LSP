<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama'       => 'Super Admin',
                'username'   => 'admin',
                'password'   => Hash::make('admin123'),
                'level'      => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama'       => 'Staff Gudang',
                'username'   => 'staff1',
                'password'   => Hash::make('staff123'),
                'level'      => 'staff',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}