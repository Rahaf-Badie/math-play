<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
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
            'email' => 'student1@example.com',
            'grade_id' => 1,
            'password' => Hash::make('password1'),
        ]);

        User::create([
            'name' => 'دينا تامر طلال الحلو',
            'email' => 'student2@example.com',
            'grade_id' => 2,
            'password' => Hash::make('password2'),
        ]);
        User::create([
            'name' => 'سعاد تامر طلال الحلو',
            'email' => 'student62@example.com',
            'grade_id' => 4,
            'password' => Hash::make('password62'),
        ]);
        User::create([
            'name' => 'وداد عمر محمد المصري',
            'email' => 'student3@example.com',
            'grade_id' => 3,
            'password' => Hash::make('password3'),
        ]);

        User::create([
            'name' => 'ولاء رامي جلال الطبش',
            'email' => 'student4@example.com',
            'grade_id' => 4,
            'password' => Hash::make('password4'),
        ]);
        User::create([
            'name' => 'محمد محمود بديع أبو زرقة',
            'email' => 'student5@example.com',
            'grade_id' => 2,
            'password' => Hash::make('password5'),
        ]);

        User::create([
            'name' => 'مصطفى عادل كامل قديح',
            'email' => 'student6@example.com',
            'grade_id' => 3,
            'password' => Hash::make('password6'),
        ]);

    }
}
