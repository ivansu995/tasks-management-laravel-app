<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('tasks/task/{slug}', 'App\Http\Controllers\TaskController@showBySlug');
Route::resource('tasks', 'App\Http\Controllers\TaskController');
Route::resource('comments', \App\Http\Controllers\CommentController::class);
Route::resource('task-groups', \App\Http\Controllers\TaskGroupController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
//    Route::get('tasks/task/{slug}', 'App\Http\Controllers\TaskController@showBySlug');
//    Route::resource('tasks', 'App\Http\Controllers\TaskController');
//    Route::resource('comments', \App\Http\Controllers\CommentController::class);
//    Route::resource('task-groups', \App\Http\Controllers\TaskGroupController::class);
})->middleware(['auth'])->name('dashboard');

//Route::middleware(['auth'])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});

require __DIR__.'/auth.php';

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
