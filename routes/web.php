<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\MathPlayController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
require __DIR__.'/auth.php';

// مسارات بعد تسجيل الدخول (للطالب)
Route::prefix('mathplay')->middleware(['auth'])->group(function () {

    Route::get('/home', [MathPlayController::class, 'home'])->name('mathplay.home');
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/get-lessons-by-unit/{unit}', [MathPlayController::class, 'getLessonsByUnit'])
        ->name('getLessonsByUnit');

    Route::get('/edit_student', [MathPlayController::class, 'editStudent'])->name('mathplay.edit_student');
    Route::post('/edit_student', [MathPlayController::class, 'updateStudent'])->name('mathplay.update_student');

    Route::get('/marks', [MathPlayController::class, 'marks'])->name('mathplay.marks');
    Route::get('/lesson/{id}', [MathPlayController::class, 'showLesson'])->name('mathplay.lesson');
    Route::get('/get-last-lesson', [MathPlayController::class, 'getLastLesson'])->name('mathplay.get_last_lesson');

    // PDF الدروس
    Route::get('/pdf/{lesson}', function ($lessonId) {
        $lesson = \App\Models\Lesson::findOrFail($lessonId);
        $filePath = $lesson->pdf_path;
        if (! Storage::disk('public')->exists($filePath)) {
            abort(404);
        }
        return Response::file(storage_path('app/public/'.$filePath));
    })->name('lessons.pdf');

    // AI Chat
    Route::post('/api/mathplay-ask', [MathPlayController::class, 'askQuestion']);
    Route::post('/api/reset-chat', function () {
        Session::forget('gemini_chat_history');
        return response()->json(['message' => 'تم إعادة تعيين المحادثة بنجاح!']);
    });

    // الألعاب
    Route::get('/games/play/{lesson_game}', [GameController::class, 'play'])->name('games.play');

    // 🚨 مسار الاختبار: يرسل lesson_id من الفورم
    Route::get('/exam', [MathPlayController::class, 'startExam'])->name('mathplay.exam.start');

    // إرسال النتيجة
    Route::post('/exam/submit', [MathPlayController::class, 'submitExam'])->name('mathplay.exam.submit');
    Route::get('/exam/already-done', [MathPlayController::class, 'examAlreadyDone'])->name('mathplay.exams.already_done');
});
