<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alumnis')->insert([
            'id' => 'al2023001',
            'graduationYear' => 2020,
            'email' => 'alumni@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
