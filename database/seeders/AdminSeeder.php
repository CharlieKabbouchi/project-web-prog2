<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'id' => 'a001',
            'firstName' => 'Admin',
            'lastName' => 'User',
            'Gender' => 'Male',
            'salary' => 50000,
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
