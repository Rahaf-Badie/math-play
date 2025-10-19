<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'template_url'];

    public function lesson_games()
    {
        return $this->hasMany(LessonGame::class);
    }
}
