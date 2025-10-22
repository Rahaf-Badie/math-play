<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'grade_id',
        'password',
        'is_active',
        'last_time_logged_in',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_time_logged_in' => 'datetime',
        'is_active' => 'boolean',
    ];

    // علاقته بالدرجة
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    // علاقته بنتائج الامتحانات
    public function examResults()
    {
        return $this->hasMany(ExamResults::class, 'student_id');
    }
}
