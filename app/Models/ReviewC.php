<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewC extends Model
{
    use HasFactory;

    public function getStudent(){
        return $this->belongsTo(Student::class,"student_id","id");
    }

    public function getClassT(){
        return $this->belongsTo(ClassT::class,"classt_id","id");
    }
}
