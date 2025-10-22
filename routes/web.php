<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MathPlayController;
use App\Http\Controllers\AuthController;

Route::prefix('mathplay')->group(function () {

    // الصفحة العامة (واجهة الموقع)

    Route::get('index', [MathPlayController::class, 'index'])->name('index');

    // 🔸 صفحات الزوار فقط (guest)

    Route::middleware('guest')->group(function () {
        Route::get('signin', [AuthController::class, 'showLoginForm'])->name('signin');
        Route::post('signin', [AuthController::class, 'login'])->name('signin.post');

        Route::get('signup', [AuthController::class, 'showSignupForm'])->name('signup');
        Route::post('signup', [AuthController::class, 'signup'])->name('signup.post');
    });

    // 🔸 صفحات المستخدمين المسجلين (auth)

    Route::middleware(['auth'])->group(function () {
        Route::get('edit-student/{id}', [MathPlayController::class, 'editStudent'])->name('edit-student');
        Route::post('edit-student/{id}', [MathPlayController::class, 'updateStudent'])->name('update-student');

        Route::get('reports', [MathPlayController::class, 'reports'])->name('reports');
        Route::get('lessons-page', [MathPlayController::class, 'lessonsPage'])->name('lessons-page');

        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });

    // (اختياري) صفحات تتطلب تأكيد البريد
    // Route::middleware(['auth', 'verified'])->group(function () {
    //     Route::get('verified-only-page', [MathPlayController::class, 'verifiedPage'])->name('verified.page');
    // });
});
