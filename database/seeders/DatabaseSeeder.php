<?php

namespace Database\Seeders;

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
            LessonGamesSeeder::class,
            GameContentSeeder::class,
            ExamResultsSeeder::class,
]);
    }
}
