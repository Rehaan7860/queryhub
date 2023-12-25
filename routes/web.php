<?php

use App\Http\Controllers\AcceptAnswerController;
use App\Http\Controllers\AnswersController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\VoteAnswerController;
use App\Http\Controllers\VoteQuestionController;
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

Route::get('/', [QuestionsController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Answers Routes
Route::resource('questions.answer', AnswersController::class)->except('create', 'show');
//Route::get('/answers', [AnswersController::class, 'index']);
Route::post('/questions/{question}/answers', [AnswersController::class, 'store'])->name('answers.store');
Route::get('/questions/{question}/answers/{answer}/edit', [AnswersController::class, 'edit'])->name('answers.edit');
Route::delete('/questions/{question}/answers/{answer}', [AnswersController::class, 'destroy'])->name('answers.destroy');
Route::patch('/questions/{question}/answers/{answer}', [AnswersController::class, 'update'])->name('answers.update');


Route::post('/answers/{answer}/accept', AcceptAnswerController::class)->name('answers.accept');
Route::post('/answers/{answer}/vote', VoteAnswerController::class);





// Question Routes
Route::resource('/questions', QuestionsController::class)->except('show');
Route::get('/questions/{question:slug}', [QuestionsController::class, 'show'])->name('questions.show');
Route::post('/questions/{question}/favorites', [FavoriteController::class, 'store'])->name('questions.favorite');
Route::delete('/questions/{question}/favorites', [FavoriteController::class, 'destroy'])->name('questions.unfavorite');
Route::post('/questions/{question}/vote', VoteQuestionController::class);


