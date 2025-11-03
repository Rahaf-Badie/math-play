<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'unit_id', 'description', 'video_url', 'pdf_path'];

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

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function lessonGames()
    {
        return $this->hasMany(LessonGames::class);
    }
}
