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
        'id_number',
        'role',
        'email',
        'grade_id',
        'password',
    ];

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

    // Relationship to Grade (one user belongs to one grade)
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    // Relationship to ExamResults (one user has many exam results)
    public function examResults()
    {
        return $this->hasMany(ExamResults::class);
    }

    // Relationship to Sessions (one user has many sessions)
    //public function sessions() {
    //    return $this->hasMany(Session::class);
    //}
}
