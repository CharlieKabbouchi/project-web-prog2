<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;
    
    protected $keyType = 'string';
    public $incrementing = false;

    public static function boot() {
        parent::boot();

        static::creating(function ($admin) {
            $admin->id = 't' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        });
    }

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
