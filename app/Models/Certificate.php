<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = ['graduationCertificateImage', 'description', 'teacher_id',];
    
    public function getAlumni(){
        return $this->belongsTo(Alumni::class,"alumni_id","id");
    }

    public function getTeacher(){
        return $this->belongsTo(Teacher::class,"teacher_id","id");
    }
    
}
