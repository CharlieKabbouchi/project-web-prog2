<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model {
    use HasFactory;

    public function getCourse() {
        return $this->belongsToMany(Course::class, "semester_course", "semester_id", "course_id");
    }
    public function getClassT() {
        return $this->hasMany(ClassT::class);
    }
}
