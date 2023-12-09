<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SemesterCourse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $this->call(AdminSeeder::class);
       // $this->call(AdminInsertion::class);
        $this->call(TeacherSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(ParentSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(AlumniSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(SemesterCourseSeeder::class);
    }
}
