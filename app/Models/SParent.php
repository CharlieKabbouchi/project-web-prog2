<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class SParent extends Authenticatable {
    use HasFactory;

    public function getProfile() {
        return $this->hasOne(Profile::class);
    }

    public function getStudent() {
        return $this->hasMany(Student::class);
    }
}
