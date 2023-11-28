<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function getSParent(){
        return $this->belongsTo(SParent::class,"sparent_id","id");
    }

    public function getAlumuni(){
        return $this->belongsTo(Alumuni::class,"alumuni_id","id");
    }

    public function getAdmin(){
        return $this->belongsTo(Admin::class,"admin_id","id");
    }

    public function getStudent(){
        return $this->belongsTo(Student::class,"student_id","id");
    }

    public function getTeacher(){
        return $this->belongsTo(Teacher::class,"teacher_id","id");
    }

}
