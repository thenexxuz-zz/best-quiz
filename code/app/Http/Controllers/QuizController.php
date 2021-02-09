<?php

namespace App\Http\Controllers;

use App\Models\Question;
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
        $input = $request->all();
        $questionIds = [];
        $answered = [];
        foreach ($input as $key => $value) {
            if (strpos($key, 'answer') !== false) {
                $id = substr($key, 0, strpos($key, '-'));
                $questionIds[] = $id;
                $answered[$id] = $value;
            }
        }
        $questionIds = array_unique($questionIds);
        $numberOfQuestions = count($questionIds);
        $quiz = new Quiz(
            $input['username'],
            $input['category'],
            $input['difficulty'],
            $numberOfQuestions,
            $questionIds
        );

        return view('quiz.results', [
            'quiz' => $quiz,
            'answered' => $answered
        ]);
    }
}
