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
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function getStudent() {
        return $this->belongsToMany(Event::class, "student_class_t_s", "classt_id", "student_id");
    }

    public function getStudents() {
        return $this->belongsToMany(Student::class, "student_class_t_s", "classt_id", "student_id")
                ->withPivot('attendence', 'averageGrade', 'quizGrade', 'projectGrade', 'assignmentGrade');
    }

    public function getTeacher() {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function getUploadResource() {
        return $this->hasMany(UploadResource::class, 'classt_id');
    }

    public function getReviewC() {
        return $this->hasMany(ReviewC::class, 'classt_id');
    }

    public function getAssignment() {
        return $this->hasMany(Assignment::class, 'classt_id');
    }

    public function getCalendar() {
        return $this->hasMany(Calendar::class, 'classt_id');
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
