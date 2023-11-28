<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassT extends Model
{
    use HasFactory;
    
    public function getCourse(){
        return $this->belongsTo(Course::class,"course_id","id");
    }

    public function getStudent(){
        return $this->belongsToMany(Event::class,"student_classt","classt_id","student_id");
    }

    public function getTeacher(){
        return $this->belongsTo(Teacher::class,"teacher_id","id");
    }

    public function getUploadResource(){
        return $this->hasMany(UploadResource::class);
    }

    public function getReviewC(){
        return $this->hasMany(ReviewC::class);
    }

    public function getAssignment(){
        return $this->hasMany(Assignment::class);
    }

    public function getCalendar(){
        return $this->hasMany(Calendar::class);
    }

}
