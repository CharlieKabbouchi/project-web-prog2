<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon as SupportCarbon;

class ClassT extends Model {
    use HasFactory;
    protected $fillable = [
        'startingDate',
        'endingDate',
        'course_id',
        'semester_id',
        'teacher_id',
        'abscence',
    ];
    public function getCourse() {
        return $this->belongsTo(Course::class, "course_id", "id");
    }

    public function getStudent() {
        return $this->belongsToMany(Event::class, "student_classt", "classt_id", "student_id");
    }

    public function getTeacher() {
        return $this->belongsTo(Teacher::class, "teacher_id", "id");
    }

    public function getUploadResource() {
        return $this->hasMany(UploadResource::class);
    }

    public function getReviewC() {
        return $this->hasMany(ReviewC::class);
    }

    public function getAssignment() {
        return $this->hasMany(Assignment::class);
    }

    public function getCalendar() {
        return $this->hasMany(Calendar::class);
    }

    public function getSemester() {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    public function getStartingDateAttribute($value) {
        return SupportCarbon::parse($value);
    }

    public function getEndingDateAttribute($value) {
        return SupportCarbon::parse($value);
    }
}
