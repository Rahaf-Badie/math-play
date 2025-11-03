<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameSettings extends Model
{
    use HasFactory;

    protected $fillable = ['lesson_game_id', 'min_range', 'max_range', 'operation_type'];

    protected $casts = [
        'options' => 'json',
    ];

    public function lessonGame()
    {
        return $this->belongsTo(LessonGames::class, 'lesson_game_id');
    }
}
