<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameContent extends Model
{
    use HasFactory;

    protected $table = 'game_content';

    protected $fillable = ['lesson_game_id', 'question', 'correct_answer', 'options', 'min_range', 'max_range'];

    protected $casts = [
        'options' => 'json',
    ];

    public function lessonGame()
    {
        return $this->belongsTo(LessonGames::class, 'lesson_game_id');
    }
}
