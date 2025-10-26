<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MathPlayController;
use App\Http\Controllers\ProfileController;

// الصفحة الرئيسية العامة قبل تسجيل الدخول
Route::prefix('mathplay')->group(function () {
    Route::get('/', [MathPlayController::class, 'index'])->name('mathplay.index');
});

// صفحات تسجيل الدخول والتسجيل (واجهة مخصصة)
Route::get('/mathplay/signin', function () {
    return view('mathplay.signin');
})->name('mathplay.signin');

Route::get('/mathplay/signup', function () {
    return view('mathplay.signup');
})->name('mathplay.signup');

// استدعاء مسارات Breeze الأصلية
require __DIR__ . '/auth.php';

// مسارات بعد تسجيل الدخول (للطالب)
Route::prefix('mathplay')->middleware(['auth'])->group(function () {
    Route::get('/home', [MathPlayController::class, 'home'])->name('mathplay.home');
    Route::get('/edit_student', [MathPlayController::class, 'editStudent'])->name('mathplay.edit_student');
    Route::post('/edit_student', [MathPlayController::class, 'updateStudent'])->name('mathplay.update_student');
    Route::get('/marks', [MathPlayController::class, 'marks'])->name('mathplay.marks');
    Route::get('/games', [MathPlayController::class, 'games'])->name('mathplay.games');
    Route::get('/tests', [MathPlayController::class, 'tests'])->name('mathplay.tests');
});

