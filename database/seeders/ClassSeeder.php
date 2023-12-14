<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('class_t_S')->insert([
            [
                'id' => 1,
                'startingDate' => '9-22-2023',
                'endingDate' => '12-18-2023',
                'starttime' => '00:08:50 AM',
                'endtime' => '00:11:30 AM',
                'DayofWeek' => 'Monday',
                'course_id' => '1',
                'semester_id' => '1',
                'teacher_id' => '',
                'absence' => '6',
            ],
            [
                'id' => 2,
                'startingDate' => '1',
                'endingDate' => '1',
                'starttime' => '',
                'endtime' => '',
                'DayofWeek' => '',
                'course_id' => '',
                'semester_id' => '',
                'teacher_id' => '',
                'absence' => '',
            ],
            [
                'id' => 3,
                'startingDate' => '1',
                'endingDate' => '1',
                'starttime' => '',
                'endtime' => '',
                'DayofWeek' => '',
                'course_id' => '',
                'semester_id' => '',
                'teacher_id' => '',
                'absence' => '',
            ],
        ]);
    }
}
