<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Student extends Authenticatable
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false; 

    public static function boot() {
        parent::boot();

        static::creating(function ($admin) {
            $admin->id = 's' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        });
    }

    public function getProfile(){
        return $this->hasOne(Profile::class);
    }

    public function getSParent(){
        return $this->belongsTo(SParent::class,"sparent_id","id");
    }

    public function getClassT(){
        return $this->belongsToMany(ClassT::class,"student_classt","student_id","classt_id");
    }

    public function getReviewC(){
        return $this->hasMany(ReviewC::class);
    }

    public function getSubmission(){
        return $this->hasMany(Submission::class);
    }

    public function getDepartment(){
        return $this->belongsTo(Department::class,"department_id","id");
    }

    public function getAlumuni(){
        return $this->hasOne(Alumuni::class);
    }
    
    public function getEvent(){
        return $this->belongsToMany(Event::class,"student_event","student_id","event_id");
    }

    public function getReviewE(){
        return $this->hasMany(ReviewE::class);
    }

    public function getQuestion(){
        return $this->hasMany(Question::class);
    }

    public function getCalendar(){
        return $this->hasMany(Calendar::class);
    }

}
