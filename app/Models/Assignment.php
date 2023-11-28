<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    
    public function getSubmission(){
        return $this->hasMany(Submission::class);
    }

    public function getTeacher(){
        return $this->belongsTo(Teacher::class,"teacher_id","id");
    }

    public function getClassT(){
        return $this->belongsTo(ClassT::class,"classt_id","id");
    }

}
