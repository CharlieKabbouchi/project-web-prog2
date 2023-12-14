<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('courses')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'Data Structure',
                    'credits' => 3,
                ],
                [

                    'id' => 2,
                    'name' => 'Web Programming 2',
                    'credits' => 3,
                ],
                [

                    'id' => 2,
                    'name' => 'Anatomy',
                    'credits' => 3,
                ],
                [

                    'id' => 2,
                    'name' => 'GYM',
                    'credits' => 3,
                ],
            ]
        );
    }
}
