<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    public function getAssignment(){
        return $this->belongsTo(Assignment::class,"assignment_id","id");
    }

    public function getStudent(){
        return $this->belongsTo(Student::class,"student_id","id");
    }
    
}
