<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teachers')->insert([
            'id' => 't001',
            'firstName' => 'Teacher',
            'lastName' => 'User',
            'Gender' => 'Female',
            'salary' => 30000,
            'email' => 'teacher@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
