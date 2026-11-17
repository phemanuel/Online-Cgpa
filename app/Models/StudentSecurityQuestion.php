<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSecurityQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'security_question',
        'security_answer',
    ];

    protected $hidden = [
        'security_answer',
    ];

    public function student()
    {
        return $this->belongsTo(Registration::class, 'student_id');
    }
}