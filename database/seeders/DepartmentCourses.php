<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentCourses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('department_courses')->insert([
            [
                'department_id' => '1',
                'course_id' => '1',
            ],
            [
                'department_id' => '1',
                'course_id' => '2',
            ],
            [
                'department_id' => '2',
                'course_id' => '4',
            ],
        ]);
    }
}
