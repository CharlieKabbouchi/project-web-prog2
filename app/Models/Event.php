<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'type', 'time', 'startingtime', 'endingtime', 'alumni_id'];
    public function getAlumni(){
        return $this->belongsTo(Alumni::class,"alumni_id","id");
    }

    public function getStudent(){
        return $this->belongsToMany(Student::class,"student_event","event_id","student_id");
    }

    public function getReviewE(){
        return $this->hasMany(ReviewE::class);
    }
    
}
