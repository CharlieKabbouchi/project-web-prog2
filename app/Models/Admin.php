<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class Admin extends Authenticatable {
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'firstName', 'lastName', 'gender', 'salary', 'email', 'password',];

    public static function boot() {
        parent::boot();
        static::creating(function ($admin) {
            // return DB::transaction(function () use ($admin) {
                $currentYear = date('Y');
                $nextId = self::where('id', 'like', 'A' . $currentYear . '%')->count() + 1;
                $admin->id = 'A' . $currentYear . str_pad($nextId, 3, '0', STR_PAD_LEFT);
                $admin->email = $admin->id . '@gmail.com';

                $rawPassword = Str::random(8);
                info("Raw Password for {$admin->email}: {$rawPassword}");
                $admin->password = Hash::make($rawPassword);
            // });
        });
    }

    public function getProfile() {
        return $this->hasOne(Profile::class);
    }
}
