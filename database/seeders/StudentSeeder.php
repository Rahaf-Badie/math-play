<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{

    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // تعطيل FK
        Student::truncate();                           // مسح بيانات users
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // إعادة تفعيل FK
        Student::create([
            'name' => 'علي محمود سعيد شحيبر',
            'email' => 'student1@example.com',
            'grade_id' => 1,
            'password' => Hash::make('password1'),
        ]);

        Student::create([
            'name' => 'دينا تامر طلال الحلو',
            'email' => 'student2@example.com',
            'grade_id' => 2,
            'password' => Hash::make('password2'),
        ]);
        Student::create([
            'name' => 'سعاد تامر طلال الحلو',
            'email' => 'student62@example.com',
            'grade_id' => 4,
            'password' => Hash::make('password62'),
        ]);
        Student::create([
            'name' => 'وداد عمر محمد المصري',
            'email' => 'student3@example.com',
            'grade_id' => 3,
            'password' => Hash::make('password3'),
        ]);

        Student::create([
            'name' => 'ولاء رامي جلال الطبش',
            'email' => 'student4@example.com',
            'grade_id' => 4,
            'password' => Hash::make('password4'),
        ]);
        Student::create([
            'name' => 'محمد محمود بديع أبو زرقة',
            'email' => 'student5@example.com',
            'grade_id' => 2,
            'password' => Hash::make('password5'),
        ]);

        Student::create([
            'name' => 'مصطفى عادل كامل قديح',
            'email' => 'student6@example.com',
            'grade_id' => 3,
            'password' => Hash::make('password6'),
        ]);

    }
}
