<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function difficultySelect($category)
    {
        return view('quiz.difficulty', ['category' => $category]);
    }

    public function currentQuiz(Request $request, $category)
    {
        $validated = $request->validate([
            'name' => 'required',
            'difficulty' => 'required',
        ]);

        $quiz = new Quiz(
            $request->input('name'),
            $category,
            $request->input('difficulty'),
            $request->input('numberOfQuestions')
        );

        return view('quiz.test', [
            'category' => $category,
            'quiz' => $quiz
        ]);
    }

    public function quizResults(Request $request)
    {

        return view('quiz.results', [
            'username' => $request->input('username'),
        ]);
    }
}
