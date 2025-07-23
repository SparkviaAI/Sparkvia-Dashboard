<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            [
                'question' => 'What\'s your story topic?',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 10,
                'options' => [],
                'created_by' => 1,
            ],
            [
                'question' => 'What\'s your preferred language?',
                'type' => 'single_select',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => ['English', 'German', 'Spanish', 'French', 'Dutch'],
                'created_by' => 1,
            ],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}

