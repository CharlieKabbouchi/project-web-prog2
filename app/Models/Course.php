<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    public function getSemester(){
        return $this->belongsToMany(Semester::class,"semester_courses","course_id","semester_id");
    }

    public function getDepartment(){
        return $this->belongsToMany(Department::class,"department_courses","course_id","department_id");
    }

    public function getClassT(){
        return $this->hasMany(ClassT::class);
    }

}
