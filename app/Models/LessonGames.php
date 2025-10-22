<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonGames extends Model
{
    use HasFactory;

    protected $table = 'lesson_games';

    protected $fillable = ['lesson_id', 'game_id', 'order'];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function contents()
    {
        return $this->hasMany(GameContent::class);
    }
}
