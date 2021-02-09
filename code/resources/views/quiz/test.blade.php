@extends('layouts.master')

@section('title')
    {{ ucfirst($quiz->getCategory()) }}
@endsection

@section('content')
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <h1 class="text-3xl dark:text-white">{{ ucfirst($category) }} Quiz</h1>
    </div>

    <form action="{{ route('quizResults') }}" method="POST" >
        @csrf
        <input type="hidden" name="username" value="{{ json_encode($quiz->getUsername()) }}">
        <input type="hidden" name="category" value="{{ json_encode($quiz->getCategory()) }}">
        <input type="hidden" name="difficulty" value="{{ json_encode($quiz->getDifficulty()) }}">
        @each('quiz.question', $quiz->getQuestions(), 'question', 'quiz.error')
        @if (count($quiz->getQuestions()))
            <button type="submit" class="rounded-md border-gray-500 hover:border-gray-500 dark:text-white">Submit Test</button>
        @endif
    </form>
@endsection
