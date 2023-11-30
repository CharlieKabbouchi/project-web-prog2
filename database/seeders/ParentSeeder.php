<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('s_parents')->insert([
            'id' => 'p001',
            'firstName' => 'Parent',
            'lastName' => 'User',
            'Gender' => 'Female',
            'email' => 'parent@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
