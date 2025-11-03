<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 1, 'semester_id' => 1, 'exam_url' => 'garde1sem1u1']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 1, 'semester_id' => 1, 'exam_url' => 'garde1sem1u2']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 1, 'semester_id' => 1, 'exam_url' => 'garde1sem1u3']);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 1, 'semester_id' => 1, 'exam_url' => 'garde1sem1u4']);
        Unit::create(['name' => 'الوحدة الخامسة', 'grade_id' => 1, 'semester_id' => 1, 'exam_url' => 'garde1sem1u5']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 1, 'semester_id' => 2, 'exam_url' => 'garde1sem2u1']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 1, 'semester_id' => 2, 'exam_url' => 'garde1sem2u2']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 1, 'semester_id' => 2, 'exam_url' => 'garde1sem2u3']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 2, 'semester_id' => 1, 'exam_url' => 'grade2sem1u1']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 2, 'semester_id' => 1, 'exam_url' => 'grade2sem1u2']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 2, 'semester_id' => 1, 'exam_url' => 'grade2sem1u3']);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 2, 'semester_id' => 1, 'exam_url' => 'grade2sem1u4']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 2, 'semester_id' => 2, 'exam_url' => 'grade2sem2u1']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 2, 'semester_id' => 2, 'exam_url' => 'grade2sem2u2']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 3, 'semester_id' => 1, 'exam_url' => 'grade3sem1u1']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 3, 'semester_id' => 1, 'exam_url' => 'grade3sem1u2']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 3, 'semester_id' => 1, 'exam_url' => 'grade3sem1u3']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 3, 'semester_id' => 2, 'exam_url' => 'grade3sem2u1']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 3, 'semester_id' => 2, 'exam_url' => 'grade3sem2u2']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 3, 'semester_id' => 2, 'exam_url' => 'grade3sem2u3']);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 3, 'semester_id' => 2, 'exam_url' => 'grade3sem2u4']);
        Unit::create(['name' => 'الوحدة الخامسة', 'grade_id' => 3, 'semester_id' => 2, 'exam_url' => 'grade3sem2u5']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 4, 'semester_id' => 1, 'exam_url' => 'grade4sem1u1']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 4, 'semester_id' => 1, 'exam_url' => 'grade4sem1u2']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 4, 'semester_id' => 1, 'exam_url' => 'grade4sem1u3']);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 4, 'semester_id' => 1, 'exam_url' => 'grade4sem1u4']);
        Unit::create(['name' => 'الوحدة الخامسة', 'grade_id' => 4, 'semester_id' => 1, 'exam_url' => 'grade4sem1u5']);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 4, 'semester_id' => 2, 'exam_url' => 'grade4sem1u1']);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 4, 'semester_id' => 2, 'exam_url' => 'grade4sem1u2']);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 4, 'semester_id' => 2, 'exam_url' => 'grade4sem1u3']);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 4, 'semester_id' => 2, 'exam_url' => 'grade4sem1u4']);
    }
}
