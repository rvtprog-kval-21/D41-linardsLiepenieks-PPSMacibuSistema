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

Route::get('/', function () {
    return redirect('/news');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/exercises', [App\Http\Controllers\ExercisesController::class, 'index'])->name('exercises');
Route::get('/exercises/create', [App\Http\Controllers\ExercisesController::class, 'create']);
Route::get('/exercises/show/{exercise}', [App\Http\Controllers\ExercisesController::class, 'show']);
Route::post('/exercises/post', [App\Http\Controllers\ExercisesController::class, 'store']);
Route::post('/exercises/{exercise}/send', [App\Http\Controllers\ExercisesController::class, 'send']);
Route::get('/exercises/{exercise}/submissions', [App\Http\Controllers\ExercisesController::class, 'submissions']);
Route::get('/exercises/{exercise}/solutions', [App\Http\Controllers\ExercisesController::class, 'solutions']);
Route::get('/exercises/del/{exercise}', [App\Http\Controllers\ExercisesController::class, 'delete'])->middleware('auth');
Route::get('/exercises/{exercise}/edit', [App\Http\Controllers\ExercisesController::class, 'edit'])->middleware('auth');
Route::patch('/exercises/{exercise}', [App\Http\Controllers\ExercisesController::class, 'update'])->middleware('auth');
Route::get('/exercises/{exercise}/send', [App\Http\Controllers\ExercisesController::class, 'openSend']);
Route::any('/exercises/search', [App\Http\Controllers\ExercisesController::class, 'search']);

Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
Route::get('/news/create', [App\Http\Controllers\NewsController::class, 'create'])->middleware('auth');
Route::post('/news', [App\Http\Controllers\NewsController::class, 'store'])->middleware('auth');
Route::get('/news/del/{news}', [App\Http\Controllers\NewsController::class, 'delete'])->middleware('auth');


Route::get('/rating', [App\Http\Controllers\RatingsController::class, 'index'])->name('rating');


Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->middleware('auth');
Route::get('/admin/banner', [App\Http\Controllers\AdminController::class, 'banner'])->middleware('auth');
Route::get('/admin/tags', [App\Http\Controllers\AdminController::class, 'tags'])->middleware('auth');
Route::post('/admin/banner', [App\Http\Controllers\AdminController::class, 'bannerEdit'])->middleware('auth');
Route::post('/admin/tags', [App\Http\Controllers\AdminController::class, 'tagEdit'])->middleware('auth');






Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
