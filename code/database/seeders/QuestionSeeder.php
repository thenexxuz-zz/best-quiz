<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();
        $categories = [
            'linux',
            'docker',
        ];
        $difficulties = [
            'easy',
            'medium',
            'hard',
        ];
        $tags = [
            'php',
            'cloud',
        ];

        try {
            foreach ($difficulties as $difficulty) {
                foreach ($categories as $category) {
                    $r = $client->request('GET', 'https://quizapi.io/api/v1/questions', [
                        'query' => [
                            'apiKey' => env('QUIZ_API_TOKEN'),
                            'limit' => 30,
                            'category' => $category,
                            'difficulty' => $difficulty,
                        ],
                    ]);
                    $apiQuestions = json_decode($r->getBody());
                    $this->storeQuestions($apiQuestions, $category);

                    // Sleeping for 5 seconds so as to not set off the rate limiting of the Quiz API
                    sleep(5);
                }
                foreach ($tags as $tag) {
                    $r = $client->request('GET', 'https://quizapi.io/api/v1/questions', [
                        'query' => [
                            'apiKey' => env('QUIZ_API_TOKEN'),
                            'limit' => 30,
                            'tag' => $tag,
                            'difficulty' => $difficulty,
                        ],
                    ]);
                    $apiQuestions = json_decode($r->getBody());
                    $this->storeQuestions($apiQuestions, $tag);

                    // Sleeping for 5 seconds so as to not set off the rate limiting of the Quiz API
                    sleep(5);
                }
            }
        }
        catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    private function storeQuestions($apiQuestions, $saveAsCategory)
    {
        foreach ($apiQuestions as $apiQuestion) {
            $question = new Question;
            $question->question = $apiQuestion->question;
            $question->answers = json_encode($apiQuestion->answers);
            $question->multiple_correct_answers = (bool) $apiQuestion->multiple_correct_answers;
            $question->correct_answers = json_encode($apiQuestion->correct_answers);
            $question->explanation = $apiQuestion->explanation;
            $question->category = strtolower($saveAsCategory);
            $question->difficulty = strtolower($apiQuestion->difficulty);
            $question->save();
            echo "Q) " . $apiQuestion->question . PHP_EOL;
        }
    }
}
