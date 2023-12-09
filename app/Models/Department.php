<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function getCourse(){
        return $this->belongsToMany(Course::class,"department_courses","department_id","course_id");
    }

    public function getStudent(){
        return $this->hasMany(Student::class);
    }

}
