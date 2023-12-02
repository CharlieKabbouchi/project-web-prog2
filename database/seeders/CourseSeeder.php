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
                    'name' => 'Maths',
                    'credits' => 3,
                ],
                [

                    'id' => 2,
                    'name' => 'Physics',
                    'credits' => 3,
                ],
            ]
        );
    }
}
