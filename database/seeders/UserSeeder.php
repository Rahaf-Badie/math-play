<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // تعطيل FK
        User::truncate();                           // مسح بيانات users
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // إعادة تفعيل FK
        User::create([
            'name' => 'علي محمود سعيد شحيبر',
            'gender' => 'male',
            'grade_id' => 1,
            'email' => 'student1@example.com',
            'password' => Hash::make('password1'),
        ]);

        User::create([
            'name' => 'دينا تامر طلال الحلو',
            'gender' => 'female',
            'grade_id' => 2,
            'email' => 'student2@example.com',
            'password' => Hash::make('password2'),
        ]);
        User::create([
            'name' => 'سعاد تامر طلال الحلو',
            'gender' => 'female',
            'grade_id' => 4,
            'email' => 'student62@example.com',
            'password' => Hash::make('password62'),
        ]);
        User::create([
            'name' => 'وداد عمر محمد المصري',
            'gender' => 'female',
            'grade_id' => 3,
            'email' => 'student3@example.com',
            'password' => Hash::make('password3'),
        ]);

        User::create([
            'name' => 'ولاء رامي جلال الطبش',
            'gender' => 'female',
            'grade_id' => 4,
            'email' => 'student4@example.com',
            'password' => Hash::make('password4'),
        ]);
        User::create([
            'name' => 'محمد محمود بديع أبو زرقة',
            'gender' => 'male',
            'grade_id' => 2,
            'email' => 'student5@example.com',
            'password' => Hash::make('password5'),
        ]);

        User::create([
            'name' => 'مصطفى عادل كامل قديح',
            'gender' => 'male',
            'grade_id' => 3,
            'email' => 'student6@example.com',
            'password' => Hash::make('password6'),
        ]);

    }
}
