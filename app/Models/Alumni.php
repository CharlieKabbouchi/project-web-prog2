<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Alumni extends Authenticatable {
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    public static function boot() {
        parent::boot();

        static::creating(function ($admin) {
            $admin->id = 'al' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        });
    }

    public function getProfile() {
        return $this->hasOne(Profile::class);
    }

    public function getCertificate() {
        return $this->hasMany(Certificate::class);
    }

    public function getStudent() {
        return $this->belongsTo(Student::class, "student_id", "id");
    }

    public function getEvent() {
        return $this->hasMany(Event::class);
    }
}
