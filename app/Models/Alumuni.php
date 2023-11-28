<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumuni extends Model
{
    use HasFactory;
    
    public function getProfile(){
        return $this->hasOne(Profile::class);
    }

    public function getCertificate(){
        return $this->hasMany(Certificate::class);
    }

    public function getStudent(){
        return $this->belongsTo(Student::class,"student_id","id");
    }

    public function getEvent(){
        return $this->hasMany(Event::class);
    }

}
