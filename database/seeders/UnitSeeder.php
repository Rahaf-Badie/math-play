<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 1, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_1_1_1.blade.php']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 1, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_1_1_2.blade.php']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 1, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_1_1_3.blade.php']);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 1, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_1_1_4.blade.php']);
        Unit::create(['name' => 'الوحدة الخامسة', 'grade_id' => 1, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_1_1_5.blade.php']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 1, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_1_2_1.blade.php']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 1, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_1_2_2.blade.php']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 1, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_1_2_3.blade.php']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 2, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_2_1_1.blade.php']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 2, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_2_1_2.blade.php']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 2, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_2_1_3.blade.php']);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 2, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_2_1_4.blade.php']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 2, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_2_2_1.blade.php']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 2, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_2_2_2.blade.php']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 3, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_3_1_1.blade.php']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 3, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_3_1_2.blade.php']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 3, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_3_1_3.blade.php']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 3, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_3_2_1.blade.php']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 3, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_3_2_2.blade.php']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 3, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_3_2_3.blade.php']);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 3, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_3_2_4.blade.php']);
        Unit::create(['name' => 'الوحدة الخامسة', 'grade_id' => 3, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_3_2_5.blade.php']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 4, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_4_1_1.blade.php']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 4, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_4_1_2.blade.php']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 4, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_4_1_3.blade.php']);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 4, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_4_1_4.blade.php']);
        Unit::create(['name' => 'الوحدة الخامسة', 'grade_id' => 4, 'semester_id' => 1, 'exam_url' => '/resources/views/exams/exam_4_1_5.blade.php']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 4, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_4_2_1.blade.php']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 4, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_4_2_2.blade.php']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 4, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_4_2_3.blade.php']);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 4, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_4_2_4.blade.php']);
        Unit::create(['name' => 'الوحدة الخامسة', 'grade_id' => 4, 'semester_id' => 2, 'exam_url' => '/resources/views/exams/exam_4_2_5.blade.php']);
    }
}
