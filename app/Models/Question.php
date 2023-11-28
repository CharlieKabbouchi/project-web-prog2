<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function getStudent(){
        return $this->belongsTo(Student::class,"student_id","id");
    }

    public function getAnswer(){
        return $this->hasMany(Answer::class);
    }

}
