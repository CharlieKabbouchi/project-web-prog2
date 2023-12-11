<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SParent extends Authenticatable {
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false; 

    protected $fillable = ['id', 'firstName', 'lastName', 'gender', 'email', 'password',];

    public static function boot() {
        parent::boot();
        static::creating(function ($parent) {
            // return DB::transaction(function () use ($parent) {
                $currentYear = date('Y');
                $nextId = self::where('id', 'like', 'P' . $currentYear . '%')->count() + 1;
                $parent->id = 'P' . $currentYear . str_pad($nextId, 3, '0', STR_PAD_LEFT);
                $parent->email = $parent->id . '@gmail.com';

                $rawPassword = Str::random(8);
                info("Raw Password for {$parent->email}: {$rawPassword}");
                $parent->password = Hash::make($rawPassword);
            // });
        });
    }

    public function getProfile() {
        return $this->hasOne(Profile::class);
    }

    public function getStudent() {
        return $this->hasMany(Student::class);
    }
}
