<?php

use App\Http\Controllers\MathPlayController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Grouping routes for 'mathplay' with security and controller settings
Route::group(['prefix' => 'mathplay', 'middleware' => ['web', 'auth']], function () {
    Route::controller(MathPlayController::class)->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/edit_student/{id}', 'edit_student')->name('edit_student');
        Route::post('/update','update')->name('update');
        Route::get('/reports', 'reports')->name('reports');
        Route::get('/student', 'student')->name('student');
    });

});

// Authentication routes (Signin and Signup) - these should not be protected by the 'auth' middleware
Route::controller(MathPlayController::class)->group(function () {
    Route::get('/signin', 'signin')->name('signin');
    Route::get('/signup', 'signup')->name('signup');
});

require __DIR__.'/auth.php';

