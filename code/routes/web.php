<?php

use App\Http\Controllers\QuizController;
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

Route::prefix('/quiz')->group(function () {
    Route::post('/results', [QuizController::class, 'quizResults'])->name('quizResults');
    Route::prefix('/{category}')->group(function() {
        Route::get('/', [QuizController::class, 'difficultySelect'])->name('quiz');
        Route::post('/', [QuizController::class, 'currentQuiz'])->name('currentQuiz');
    });
});


