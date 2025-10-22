<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MathPlayController;
use App\Http\Controllers\ProfileController;

// الصفحة الرئيسية تحول المستخدم إلى mathplay مباشرة
Route::get('/', function () {
    return redirect()->route('mathplay.index');
});

// جميع صفحات mathplay محمية وتتبع نفس الكنترولر
Route::middleware(['auth', 'verified'])->prefix('mathplay')->group(function () {

    // الصفحة الرئيسية للموقع (dashboard الخاص بك)
    Route::get('/', [MathPlayController::class, 'index'])->name('mathplay.index');

    // مثال على صفحات إضافية (أضيفي لاحقاً)
    //Route::get('/games', [MathPlayController::class, 'games'])->name('mathplay.games');
    //Route::get('/profile', [MathPlayController::class, 'profile'])->name('mathplay.profile');
});

// صفحات البروفايل الافتراضية من Breeze (اختياري تبقيها)
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// راوتات المصادقة (login, register, logout ...)
require __DIR__.'/auth.php';
