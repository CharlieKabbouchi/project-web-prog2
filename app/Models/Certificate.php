<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    
    public function getAlumuni(){
        return $this->belongsTo(Alumuni::class,"alumuni_id","id");
    }

    public function getTeacher(){
        return $this->belongsTo(Teacher::class,"teacher_id","id");
    }
    
}
