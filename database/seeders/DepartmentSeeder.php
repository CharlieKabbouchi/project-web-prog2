<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        //
        DB::table('departments')->insert([
            [
                'id' => '1',
                'name' => 'Engineering',
                'location' => 'Zahle',
                'totalCredits' => 156,
            ],
            [
                'id' => '2',
                'name' => 'Sport',
                'location' => 'Zahle',
                'totalCredits' => 90,
            ],
            [
                'id' => '3',
                'name' => 'Medicine',
                'location' => 'Baabda',
                'totalCredits' => 200,
            ],
        ]);
    }
}
