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
            'id' => 'A2023001',
            'firstName' => 'Abbas',
            'lastName' => 'Zreik',
            'isSuper' => 0,
            'Gender' => 'Male',
            'salary' => 2000,
            'email' => 'A2023001@gmail.com',
            'password' => Hash::make('123'),
        ]);
    }
}
