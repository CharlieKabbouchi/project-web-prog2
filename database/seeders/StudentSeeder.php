<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        //
        DB::table('students')->insert([
            [
                'id' => 's2023001',
                'firstName' => 'Student',
                'lastName' => 'User',
                'Gender' => 'Male',
                'isGraduated' => false,
                'totalCreditsTaken' => 0,
                'department_id' => 1,
                'sparent_id' => 'p2023001',
                'email' => 'student@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'id' => 's2023002',
                'firstName' => 'Student2',
                'lastName' => 'User2',
                'Gender' => 'Male',
                'isGraduated' => true,
                'totalCreditsTaken' => 150,
                'department_id' => 1,
                'sparent_id' => 'p2023001',
                'email' => 's2023002@gmail.com',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
