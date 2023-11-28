<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SParent extends Model
{
    use HasFactory;

    public function getProfile(){
        return $this->hasOne(Profile::class);
    }

    public function getStudent(){
        return $this->hasMany(Student::class);
    }
}
