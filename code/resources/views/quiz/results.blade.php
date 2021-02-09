@extends('layouts.master')

@section('content')
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <h1 class="text-3xl dark:text-white">Results for {{ $quiz->getCategory() }} Quiz</h1>
    </div>

    @foreach($quiz->getQuestions() as $question)
        @include('quiz.question-answered', [$question, $answered])
    @endforeach

    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg mb-20">
        <div class="grid grid-cols-1 md:grid-cols-1">
            <div class="p-6">
                <div class="ml-2">
                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        <div class="mb-5">
                            <strong>{{ $quiz->getResults($answered) }} out of {{ $quiz->getNumberOfQuestions() }} correct</strong>
                        </div>
                        <div>
                            <a href="{{ route('welcome') }}">Try another quiz!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
