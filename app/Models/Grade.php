<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relationship to Students (one grade has many students)
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // A better way to define the relationship to Lessons
    // A Grade has many Lessons THROUGH Units
    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Unit::class);
    }

    // It's also good practice to define the direct relationship to Semesters and Units
    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
