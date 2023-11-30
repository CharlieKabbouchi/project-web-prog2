<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('students')->insert([
            'id' => 's2023001',
            'firstName' => 'Student',
            'lastName' => 'User',
            'Gender' => 'Male',
            'totalCreditsTaken'=>0,
            'isGraduated'=>false,
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
