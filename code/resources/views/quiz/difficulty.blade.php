@extends('layouts.master')

@section('title')
    {{ ucfirst($category) }}
@endsection

@section('style')
    #sliderTitle {
        display: none;
        position: absolute;
        cursor: default;
        top: 0;
        left: 0;
    }

    #sliderContainer:hover > #sliderTitle {
        display: block;
    }
@endsection

@section('content')
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <h1 class="text-3xl dark:text-white">{{ ucfirst($category) }} Quiz</h1>
    </div>
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-1">
            <div class="p-6">
                <div class="ml-2">
                    <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-500">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('currentQuiz', ['category' => $category]) }}">
                            @csrf
                            <input type='text' name="name" placeholder="Name" class="block w-full text-gray-700"/> <br/> <br/>
                            <select name="difficulty" class="block w-full mt-1 rounded-md border-transparent focus:border-gray-500 focus:ring-0 text-gray-700">
                                <option disabled selected>Difficulty</option>
                                <option value="easy">Easy</option>
                                <option value="medium">Medium</option>
                                <option value="hard">Hard</option>
                            </select> <br/> <br/>
                            <div id="sliderContainer" class="block w-full">
                                <label for="numberOfQuestions">Number of questions</label> <br/> <br/>
                                <input id="numberOfQuestions" name="numberOfQuestions" type="range" min="5" max="20" value="10" class="block w-full"> <br/> <br/>
                                <span id="sliderTitle"></span>
                            </div>

                            <button type="submit" class="rounded-md border-gray-500 hover:border-gray-500">Start Test</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    var slider = document.getElementById("numberOfQuestions");
    var slidertitle = document.getElementById("sliderTitle");

    var sliderOffsetX = slider.getBoundingClientRect().left - document.documentElement.getBoundingClientRect().left;
    var sliderOffsetY = slider.getBoundingClientRect().top - document.documentElement.getBoundingClientRect().top;

    var sliderWidth = slider.offsetWidth - 1;

    slider.addEventListener('mousemove', function(event) {
        var currentMouseXPos = (event.clientX + window.pageXOffset) - sliderOffsetX;
        var sliderValAtPos = Math.round(currentMouseXPos / sliderWidth * 15 + 5);
        // this...
        if(sliderValAtPos < 5) sliderValAtPos = 5;
        // ... and this are to make it easier to hover on the "0" and "100" positions
        if(sliderValAtPos > 20) sliderValAtPos = 20;
        slidertitle.innerHTML = sliderValAtPos;
        slidertitle.style.top = sliderOffsetY - 15 + 'px';
        slidertitle.style.left = event.clientX + 'px';
    });
@endsection
