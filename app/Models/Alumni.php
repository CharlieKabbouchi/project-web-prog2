<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Alumni extends Authenticatable {
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['id', 'graduationYear', 'student_id', 'email', 'password',];

    public static function boot() {
        parent::boot();

        static::creating(function ($alumni) {
            return DB::transaction(function () use ($alumni) {
                $currentYear = date('Y');
                $nextId = self::where('id', 'like', 'al' . $currentYear . '%')->count() + 1;
                $alumni->id = 'al' . $currentYear . str_pad($nextId, 3, '0', STR_PAD_LEFT);
                $alumni->email = $alumni->id . '@gmail.com';

                $rawPassword = Str::random(8);
                info("Raw Password for {$alumni->email}: {$rawPassword}");
                $alumni->password = Hash::make($rawPassword);
            });
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
