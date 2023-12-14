<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profiles')->insert([
            'phone' => '+96176033727',
            'email' => 'abs123zk@gmail.com',
            'image' => "CHANGE PICTURE",
            'dateOfBirth' => '2001-09-09',
            'alumni_id' => NULL,
            'teacher_id' => NULL,
            'student_id' => NULL,
            's_parent_id' => NULL,
            'admin_id' => 'A2023001',
        ]);
    }
}
