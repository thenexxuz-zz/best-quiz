<?php

namespace App\Models;

class Quiz
{
    private $questions;
    private $numberOfQuestions;
    private $username;
    private $category;
    private $difficulty;

    /**
     * Quiz constructor.
     */
    public function __construct($username, $category, $difficulty, $numberOfQuestions)
    {
        $this->setUsername($username);
        $this->setCategory($category);
        $this->setDifficulty($difficulty);
        $this->setNumberOfQuestions($numberOfQuestions);

        $questions = Question::where([
            'category' => $this->getCategory(),
            'difficulty' => $this->getDifficulty(),
        ])
            ->inRandomOrder()
            ->limit($this->getNumberOfQuestions())
            ->get()->toArray();
        $this->setQuestions($questions);
    }

    /**
     * @return array
     */
    public function getQuestions(): array
    {
        return $this->questions;
    }

    /**
     * @param array $questions
     */
    public function setQuestions(array $questions): void
    {
        $this->questions = $questions;
    }

    /**
     * @return int
     */
    public function getNumberOfQuestions(): int
    {
        return $this->numberOfQuestions;
    }

    /**
     * @param int $numberOfQuestions
     */
    public function setNumberOfQuestions(int $numberOfQuestions): void
    {
        $this->numberOfQuestions = $numberOfQuestions;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return null
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param null $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getDifficulty(): string
    {
        return $this->difficulty;
    }

    /**
     * @param string $difficulty
     */
    public function setDifficulty(string $difficulty): void
    {
        $this->difficulty = $difficulty;
    }

}
