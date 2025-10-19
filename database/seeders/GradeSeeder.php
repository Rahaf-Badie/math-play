<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Grade::create(['name' => 'الصف الأول']);
        Grade::create(['name' => 'الصف الثاني']);
        Grade::create(['name' => 'الصف الثالث']);
        Grade::create(['name' => 'الصف الرابع']);
    }
}
