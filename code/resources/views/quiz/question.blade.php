<div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
    <div class="grid grid-cols-1 md:grid-cols-1">
        <div class="p-6">
            <div class="ml-12">
                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                    <div>
                        <strong>{{ $question['question'] }}</strong>
                    </div>
                    <div>
                        @foreach(json_decode($question['answers'], true) as $key => $answer)
                            @if(!is_null($answer))
                                <div>
                                    <input type="checkbox" id="question-{{ $question['id'] }}-{{ $key }}" name="question-{{ $question['id'] }}-{{ $key }}" value="{{ $key }}">
                                    <label for="question-{{ $question['id'] }}-{{ $key }}">{{ $answer }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
