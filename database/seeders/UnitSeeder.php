<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 1, 'semester_id' => 1]);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 1, 'semester_id' => 1]);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 1, 'semester_id' => 1]);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 1, 'semester_id' => 1]);
        Unit::create(['name' => 'الوحدة الخامسة', 'grade_id' => 1, 'semester_id' => 1]);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 1, 'semester_id' => 2]);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 1, 'semester_id' => 2]);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 1, 'semester_id' => 2]);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 2, 'semester_id' => 1]);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 2, 'semester_id' => 1]);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 2, 'semester_id' => 1]);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 2, 'semester_id' => 1]);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 2, 'semester_id' => 2]);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 2, 'semester_id' => 2]);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 3, 'semester_id' => 1]);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 3, 'semester_id' => 1]);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 3, 'semester_id' => 1]);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 3, 'semester_id' => 2]);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 3, 'semester_id' => 2]);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 3, 'semester_id' => 2]);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 3, 'semester_id' => 2]);
        Unit::create(['name' => 'الوحدة الخامسة', 'grade_id' => 3, 'semester_id' => 2]);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 4, 'semester_id' => 1]);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 4, 'semester_id' => 1]);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 4, 'semester_id' => 1]);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 4, 'semester_id' => 1]);
        Unit::create(['name' => 'الوحدة الخامسة', 'grade_id' => 4, 'semester_id' => 1]);

        Unit::create(['name' => 'الوحدة الأولى', 'grade_id' => 4, 'semester_id' => 2]);
        Unit::create(['name' => 'الوحدة الثانية', 'grade_id' => 4, 'semester_id' => 2]);
        Unit::create(['name' => 'الوحدة الثالثة', 'grade_id' => 4, 'semester_id' => 2]);
        Unit::create(['name' => 'الوحدة الرابعة', 'grade_id' => 4, 'semester_id' => 2]);
        Unit::create(['name' => 'الوحدة الخامسة', 'grade_id' => 4, 'semester_id' => 2]);
    }
}
