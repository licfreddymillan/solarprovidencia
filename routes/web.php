<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'courses'], function () {
        Route::get('/', [App\Http\Controllers\CourseController::class, 'index'])->name('admin.courses');
        Route::post('store', [App\Http\Controllers\CourseController::class, 'store'])->name('admin.courses.store');
        Route::post('update', [App\Http\Controllers\CourseController::class, 'update'])->name('admin.courses.update');
        Route::get('delete/{id}', [App\Http\Controllers\CourseController::class, 'destroy'])->name('admin.courses.delete');

        Route::group(['prefix' => 'lessons'], function () {
            Route::get('/{course_id}', [App\Http\Controllers\LessonController::class, 'index'])->name('admin.courses.lessons');
            Route::get('/show/{lesson_id}', [App\Http\Controllers\LessonController::class, 'show'])->name('admin.courses.lessons.show');
            Route::post('store', [App\Http\Controllers\LessonController::class, 'store'])->name('admin.courses.lessons.store');
            Route::post('update', [App\Http\Controllers\LessonController::class, 'update'])->name('admin.courses.lessons.update');
            Route::get('delete/{id}', [App\Http\Controllers\LessonController::class, 'destroy'])->name('admin.courses.lessons.delete');
        });
    });

    Route::group(['prefix' => 'news'], function () {
        Route::get('/', [App\Http\Controllers\NewController::class, 'index'])->name('admin.news');
        Route::post('store', [App\Http\Controllers\NewController::class, 'store'])->name('admin.news.store');
        Route::post('update', [App\Http\Controllers\NewController::class, 'update'])->name('admin.news.update');
        Route::get('delete/{id}', [App\Http\Controllers\NewController::class, 'destroy'])->name('admin.news.delete');
    });
});

Route::group(['prefix' => 'courses'], function () {
    Route::get('/', [App\Http\Controllers\CourseController::class, 'search'])->name('courses.index');
    Route::get('show/{slug}/{id}',  [App\Http\Controllers\CourseController::class, 'show'])->name('courses.show');
    Route::get('category/{slug}/{id}', [App\Http\Controllers\CourseController::class, 'search_by_category'])->name('courses.search-by-category');
    Route::get('search', [App\Http\Controllers\CourseController::class, 'search'])->name('courses.search');
});

Route::group(['prefix' => 'news'], function () {
    Route::get('/', [App\Http\Controllers\NewController::class, 'index'])->name('news.index');
    Route::get('show/{slug}/{id}',  [App\Http\Controllers\NewController::class, 'show'])->name('news.show');
});
