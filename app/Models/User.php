<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'gender',
        'grade_id',
        'email',
        'password',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function examResults()
    {
        return $this->hasMany(ExamResults::class, 'student_id');
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    // Relationship to Sessions (one user has many sessions)
    //public function sessions() {
    //    return $this->hasMany(Session::class);
    //}
}
