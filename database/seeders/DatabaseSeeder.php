<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GradeSeeder::class,
            UserSeeder::class,
            SemesterSeeder::class,
            UnitSeeder::class,
            LessonSeeder::class,
            GameSeeder::class,
            LessonGamesSeeder::class,
            GameSettingsSeeder::class,
            ExamResultsSeeder::class,
]);
    }
}
