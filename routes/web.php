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
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});


Route::get('/', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('index');

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

     Route::group(['prefix' => 'events'], function () {
        Route::get('/', [App\Http\Controllers\EventController::class, 'index'])->name('admin.events');
        Route::post('store', [App\Http\Controllers\EventController::class, 'store'])->name('admin.events.store');
        Route::post('update', [App\Http\Controllers\EventController::class, 'update'])->name('admin.events.update');
        Route::get('delete/{id}', [App\Http\Controllers\EventController::class, 'destroy'])->name('admin.events.delete');
        Route::get('subscribers/{id}', [App\Http\Controllers\EventController::class, 'subscribers'])->name('admin.events.subscribers');
        Route::post('send-mail', [App\Http\Controllers\EventController::class, 'send_mail'])->name('admin.events.send-mail');
    });

    Route::group(['prefix' => 'news'], function () {
        Route::get('/', [App\Http\Controllers\NewController::class, 'index'])->name('admin.news');
        Route::post('store', [App\Http\Controllers\NewController::class, 'store'])->name('admin.news.store');
        Route::post('update', [App\Http\Controllers\NewController::class, 'update'])->name('admin.news.update');
        Route::get('delete/{id}', [App\Http\Controllers\NewController::class, 'destroy'])->name('admin.news.delete');
    });

    Route::group(['prefix' => 'transfers'], function(){
        Route::get('/', [App\Http\Controllers\TransferController::class, 'index'])->name('admin.transfers.index');
        Route::get('pending', [App\Http\Controllers\TransferController::class, 'pending_transfers'])->name('admin.transfers.pending');
        Route::get('change-status/{id}/{status}', [App\Http\Controllers\TransferController::class, 'change_status'])->name('admin.transfers.change-status');
    });

    Route::group(['prefix' => 'purchases'], function(){
        Route::get('/', [App\Http\Controllers\TransferController::class, 'purchases'])->name('admin.purchases.index');
    });

    Route::group(['prefix' => 'users'], function(){
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
    });

    Route::get('pending-class', [App\Http\Controllers\CourseController::class, 'pending_class'])->name('admin.pending-class');
    Route::get('finalize-class', [App\Http\Controllers\CourseController::class, 'finalize_class'])->name('admin.finalize-class');
});

Route::get('search', [App\Http\Controllers\HomeController::class, 'search'])->name('search');
Route::get('terms-and-conditions', function(){
    return view('user.termsAndConditions');
})->name('terms-and-conditions');
Route::get('about-us', function(){
    return view('user.aboutUs');
})->name('about-us');

Route::group(['prefix' => 'courses'], function () {
    Route::get('/', [App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
    Route::get('show/{slug}/{id}',  [App\Http\Controllers\CourseController::class, 'show'])->name('courses.show');
    Route::get('category/{slug}/{id}', [App\Http\Controllers\CourseController::class, 'search_by_category'])->name('courses.search-by-category');
    Route::get('search', [App\Http\Controllers\CourseController::class, 'search'])->name('courses.search');
});

Route::group(['prefix' => 'events'], function () {
    Route::get('/', [App\Http\Controllers\EventController::class, 'index'])->name('events.index');
    Route::get('show/{slug}/{id}',  [App\Http\Controllers\EventController::class, 'show'])->name('events.show');
    Route::get('search', [App\Http\Controllers\EventController::class, 'search'])->name('events.search');
});

Route::group(['prefix' => 'news'], function () {
    Route::get('/', [App\Http\Controllers\NewController::class, 'index'])->name('news.index');
    Route::get('show/{slug}/{id}',  [App\Http\Controllers\NewController::class, 'show'])->name('news.show');
});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    Route::get('my-courses', [App\Http\Controllers\CourseController::class, 'my_courses'])->name('user.my-courses');
    Route::get('course-resume/{slug}/{id}',  [App\Http\Controllers\CourseController::class, 'resume'])->name('user.course-resume');
    Route::get('add/{slug}/{id}',  [App\Http\Controllers\CourseController::class, 'add_course'])->name('user.course-add');
    Route::get('my-events', [App\Http\Controllers\EventController::class, 'my_events'])->name('user.my-events');
    Route::get('event-resume/{slug}/{id}',  [App\Http\Controllers\EventController::class, 'resume'])->name('user.event-resume');
    Route::get('show-event-video/{slug}/{id}',  [App\Http\Controllers\EventController::class, 'show_video'])->name('user.show-event-video');
    Route::post('request-online-class',  [App\Http\Controllers\CourseController::class, 'request_online_class'])->name('user.request-online-class');
    Route::get('show-lesson/{slug}/{id}',  [App\Http\Controllers\LessonController::class, 'show_lesson'])->name('user.show-lesson');
    Route::post('new-bank-transfer', [App\Http\Controllers\TransferController::class, 'store'])->name('user.transfers.store');
    Route::post('paypal-checkout', [App\Http\Controllers\PaypalController::class, 'payment'])->name('paypal-checkout');
    Route::get('process-paypal-checkout', [App\Http\Controllers\PaypalController::class, 'process_payment'])->name('process-paypal-checkout');
    Route::get('get-certificate/{course_id}', [App\Http\Controllers\CourseController::class, 'get_certificate'])->name('user.get-certificate');
});

