<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Admin extends Authenticatable {
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    
    public static function boot() {
        parent::boot();

        static::creating(function ($admin) {
            $admin->id = 'a' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        });
    }

    public function getProfile() {
        return $this->hasOne(Profile::class);
    }
}
