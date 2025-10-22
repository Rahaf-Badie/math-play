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
            'name' => 'Rahaf',
            'email' => 'rahaf@gmail.com',
            'grade_id' => 1,
            'password' => Hash::make('12345'),
        ]);

    }
}
