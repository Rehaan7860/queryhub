<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\QuestionsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::redirect('/', '/questions');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/questions', QuestionsController::class)->except('show');
Route::post('/questions/{question}/answers', [AnswersController::class, 'store'])->name('answers.store');
Route::get('/questions/{question:slug}', [QuestionsController::class, 'show'])->name('questions.show');
