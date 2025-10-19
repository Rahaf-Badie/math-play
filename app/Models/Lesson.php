<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'unit_id', 'grade_id', 'semester_id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    
    public function lessonGames()
    {
        return $this->hasMany(LessonGame::class);
    }
}
