<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('semesters')->insert(
            [
                [
                    'id' => 1,
                    'yearBelongsTo' => 2023/2024,
                    'startingDate' => '2023-9-19',
                    'endingDate' => '2023-12-19',
                    'type' => 'Fall',
                ],
                [
                    'id' => 2,
                    'yearBelongsTo' => 2023/2024,
                    'startingDate' => '2024-02-22',
                    'endingDate' => '2024-05-23',
                    'type' => 'Spring',
                ],
            ]
        );
    }
}
