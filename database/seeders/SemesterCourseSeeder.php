<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterCourseSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('semester_courses')->insert(
            [
                [
                    'course_id' => 1,
                    'semester_id' => 1,
                ],
                [
                    'course_id' => 2,
                    'semester_id' => 1
                ]
            ]
        );
    }
}
