<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Engine;


class EngineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $engines = [
            [
                'type' => 'chat',
                'title' => 'GPT-4',
                'value' => 'gpt-4',
                'created_by' => 1,
                'max_tokens' => 8192
            ],[
                'type' => 'chat',
                'title' => 'GPT-3.5 Turbo',
                'value' => 'gpt-3.5-turbo',
                'created_by' => 1,
                'max_tokens' => 4096
            ],[
                'type' => 'text',
                'title' => 'GPT-3 / text-davinci-003',
                'value' => 'text-davinci-003',
                'created_by' => 1,
                'max_tokens' => 4097
            ],[
                'type' => 'text',
                'title' => 'GPT-3 / text-curie-001',
                'value' => 'text-curie-001',
                'created_by' => 1,
                'max_tokens' => 2049
            ],[
                'type' => 'text',
                'title' => 'GPT-3 / text-babbage-001',
                'value' => 'text-babbage-001',
                'created_by' => 1,
                'max_tokens' => 2049
            ],[
                'type' => 'text',
                'title' => 'GPT-3 / text-ada-001',
                'value' => 'text-ada-001',
                'created_by' => 1,
                'max_tokens' => 2049
            ],[
                'type' => 'text',
                'title' => 'GPT-3 / code-cushman-001',
                'value' => 'code-cushman-001',
                'created_by' => 1,
                'max_tokens' => 2049
            ],




            [
                'type' => 'text',
                'title' => 'Codex / code-davinci-002',
                'value' => 'code-davinci-002',
                'created_by' => 1,
                'max_tokens' => 8001
            ],
            [
                'type' => 'chat',
                'title' => 'GPT-3.5 Turbo 16k',
                'value' => 'gpt-3.5-turbo-16k',
                'created_by' => 1,
                'max_tokens' => 16384
            ],
            [
                'type' => 'chat',
                'title' => 'GPT-4',
                'value' => 'gpt-4',
                'created_by' => 1,
                'max_tokens' => 8192
            ],
            [
                'type' => 'chat',
                'title' => 'GPT-3.5 Turbo',
                'value' => 'gpt-3.5-turbo',
                'created_by' => 1,
                'max_tokens' => 4096
            ],
            [
                'type' => 'text',
                'title' => 'GPT-3 / text-davinci-003',
                'value' => 'text-davinci-003',
                'created_by' => 1,
                'max_tokens' => 4097
            ],
            [
                'type' => 'text',
                'title' => 'GPT-3 / text-curie-001',
                'value' => 'text-curie-001',
                'created_by' => 1,
                'max_tokens' => 2049
            ],
            [
                'type' => 'text',
                'title' => 'GPT-3 / text-babbage-001',
                'value' => 'text-babbage-001',
                'created_by' => 1,
                'max_tokens' => 2049
            ],
            [
                'type' => 'text',
                'title' => 'GPT-3 / text-ada-001',
                'value' => 'text-ada-001',
                'created_by' => 1,
                'max_tokens' => 2049
            ],


            [
                'type' => 'text',
                'title' => 'GPT-3 / code-cushman-001',
                'value' => 'code-cushman-001',
                'created_by' => 1,
                'max_tokens' => 2049
            ],
            [
                'type' => 'text',
                'title' => 'Codex / code-davinci-002',
                'value' => 'code-davinci-002',
                'created_by' => 1,
                'max_tokens' => 8001
            ],
            [
                'type' => 'text',
                'title' => 'GPT-3.5 Turbo 16k',
                'value' => 'gpt-3.5-turbo-16k',
                'created_by' => 1,
                'max_tokens' => 16384
            ],


        ];

        foreach ($engines as $row) {
            Engine::create($row);
        }

    }
}
