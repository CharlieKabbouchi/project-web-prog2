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
                    'yearBelongsTo' => 2023,
                    'startingDate' => now(),
                    'endingDate' => now()->addMonths(3),
                    'type' => 'Fall',
                ],
                [
                    'id' => 2,
                    'yearBelongsTo' => 2023,
                    'startingDate' => now()->addMonths(4),
                    'endingDate' => now()->addMonths(6),
                    'type' => 'Spring',
                ],
            ]
        );
    }
}
