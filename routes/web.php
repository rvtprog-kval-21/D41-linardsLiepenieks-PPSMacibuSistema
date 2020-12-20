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
Route::get('/exercises/del/{exercise}', [App\Http\Controllers\ExercisesController::class, 'delete']);
Route::get('/exercises/{exercise}/send', [App\Http\Controllers\ExercisesController::class, 'openSend']);

Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
Route::get('/news/create', [App\Http\Controllers\NewsController::class, 'create']);
Route::post('/news', [App\Http\Controllers\NewsController::class, 'store']);
Route::get('/news/del/{news}', [App\Http\Controllers\NewsController::class, 'delete']);


Route::get('/rating', [App\Http\Controllers\RatingsController::class, 'index'])->name('rating');





