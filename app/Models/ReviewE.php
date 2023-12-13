<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewE extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'rating', 'event_id', 'student_id'];
    public function getEvent(){
        return $this->belongsTo(Event::class,"event_id","id");
    }

    public function getStudent(){
        return $this->belongsTo(Student::class,"student_id","id");
    }
    
}
