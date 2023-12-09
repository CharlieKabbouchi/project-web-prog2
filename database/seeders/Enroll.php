<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Enroll extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('student_class_t_s')->insert([
            "student_id"=>"S2018110","classt_id"=>5,"attendence"=>6,"averageGrade"=>4.2,"quizGrade"=>10,"projectGrade"=>12.1,"assignmentGrade"=>10.1,]);
    }
    }

