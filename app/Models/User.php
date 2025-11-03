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
        'is_active',
        'last_time_logged_in',
        'last_lesson_id',
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
            'last_time_logged_in' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function lastLesson()
    {
        return $this->belongsTo(Lesson::class, 'last_lesson_id');
    }

    // أضف هذه الدالة لشريط التقدم
    public function getUnitProgress($unitId)
    {
        $totalLessons = Lesson::where('unit_id', $unitId)->count();
        
        if ($totalLessons == 0) return ['percentage' => 0, 'completed' => 0, 'total' => 0];
        
        $completedLessons = Lesson::where('unit_id', $unitId)
            ->whereHas('lessonGames', function($query) {
                $query->where('user_id', $this->id);
            })
            ->count();
        
        return [
            'percentage' => $totalLessons > 0 ? round(($completedLessons / $totalLessons) * 100) : 0,
            'completed' => $completedLessons,
            'total' => $totalLessons
        ];
    }

    // Relationship to Sessions (one user has many sessions)
    //public function sessions() {
    //    return $this->hasMany(Session::class);
    //}
}
