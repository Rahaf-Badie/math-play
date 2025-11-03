<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameSettings;
use App\Models\Lesson;
use App\Models\LessonGames;

class GameController extends Controller
{
    public function show(Lesson $lesson, Game $game)
    {
        $lessonGame = LessonGames::where('lesson_id', $lesson->id)
            ->where('game_id', $game->id)
            ->firstOrFail();

        $settings = GameSettings::where('lesson_game_id', $lessonGame->id)->first();

        return view('mathplay.games.'.$game->template_url, [
            'lesson' => $lesson,
            'game' => $game,
            'settings' => $settings,
        ]);
    }

    public function play(LessonGames $lesson_game)
    {
        // جلب إعدادات اللعبة للدرس الحالي
        $settings = $lesson_game->game_settings;

        $min = $settings->min_range ?? 1;
        $max = $settings->max_range ?? 9;
        $operation_type = $settings->operation_type ?? 'addition';

        return view('mathplay.games.'.$lesson_game->game->template_url, [
            'lesson_game' => $lesson_game,
            'settings' => $settings,
            'min_range' => $min,
            'max_range' => $max,
            'operation_type' => $operation_type,
        ]);
    }
}
