<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    
    public function getProfile(){
        return $this->hasOne(Profile::class);
    }

    public function getCertificate(){
        return $this->hasMany(Certificate::class);
    }

    public function getClassT(){
        return $this->hasMany(ClassT::class);
    }

    public function getUploadResource(){
        return $this->hasMany(UploadResource::class);
    }

    public function getAssignment(){
        return $this->hasMany(Assignment::class);
    }

    public function getCalendar(){
        return $this->hasMany(Calendar::class);
    }
    
}
