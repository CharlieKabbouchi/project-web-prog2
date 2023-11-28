<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function getAlumuni(){
        return $this->belongsTo(Alumuni::class,"alumuni_id","id");
    }

    public function getStudent(){
        return $this->belongsToMany(Student::class,"student_event","event_id","student_id");
    }

    public function getReviewE(){
        return $this->hasMany(ReviewE::class);
    }
    
}
