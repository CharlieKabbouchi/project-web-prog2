<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Student extends Authenticatable {
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'firstName', 'lastName', 'gender', 'department_id', 's_parent_id', 'email', 'password',];

    public static function boot() {
        parent::boot();
        static::creating(function ($student) {
            return DB::transaction(function () use ($student) {
                $currentYear = date('Y');
                $nextId = self::where('id', 'like', 'S' . $currentYear . '%')->count() + 1;
                $student->id = 'S' . $currentYear . str_pad($nextId, 3, '0', STR_PAD_LEFT);
                $student->email = $student->id . '@gmail.com';

                $rawPassword = Str::random(8);
                info("Raw Password for {$student->email}: {$rawPassword}");
                $student->password = Hash::make($rawPassword);
            });
        });
    }

    public function getProfile() {
        return $this->hasOne(Profile::class);
    }

    public function getSParent() {
        return $this->belongsTo(SParent::class, "s_parent_id", "id");
    }

    public function getClassT(){
        return $this->belongsToMany(ClassT::class,"student_class_t_s","student_id","classt_id");
    }


    public function getReviewC() {
        return $this->hasMany(ReviewC::class);
    }

    public function getSubmission() {
        return $this->hasMany(Submission::class);
    }

    public function getDepartment() {
        return $this->belongsTo(Department::class, "department_id", "id");
    }

    public function getAlumni() {
        return $this->hasOne(Alumni::class);
    }

    public function getEvent() {
        return $this->belongsToMany(Event::class, "student_event", "student_id", "event_id");
    }

    public function getReviewE() {
        return $this->hasMany(ReviewE::class);
    }

    public function getQuestion() {
        return $this->hasMany(Question::class);
    }

    public function getCalendar() {
        return $this->hasMany(Calendar::class);
    }
}
