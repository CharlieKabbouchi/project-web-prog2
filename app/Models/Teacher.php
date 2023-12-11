<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Teacher extends Authenticatable
{
    use HasFactory;
    
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'firstName', 'lastName', 'gender', 'salary', 'email', 'password',];

    public static function boot() {
        parent::boot();

        static::creating(function ($teacher) {
            return DB::transaction(function () use ($teacher) {
                $currentYear = date('Y');
                $nextId = self::where('id', 'like', 'T' . $currentYear . '%')->count() + 1;
                $teacher->id = 'T' . $currentYear . str_pad($nextId, 3, '0', STR_PAD_LEFT);
                $teacher->email = $teacher->id . '@gmail.com';

                $rawPassword = Str::random(8);
                info("Raw Password for {$teacher->email}: {$rawPassword}");
                $teacher->password = Hash::make($rawPassword);
            });
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
