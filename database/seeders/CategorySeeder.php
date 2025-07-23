<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'title' => '🌐 Website Tools',
                'created_by' => 1,
            ],
            [
                'id' => 2,
                'title' => '🎯 Copywriting Tools',
                'created_by' => 1,
            ],
            [
                'id' => 3,
                'title' => '🎶 Music Tools',
                'created_by' => 1,
            ],
            [
                'id' => 4,
                'title' => '💰 E-Commerce Tools',
                'created_by' => 1,
            ],
            [
                'id' => 5,
                'title' => '💻 Writing Assistant',
                'created_by' => 1,
            ],
            [
                'id' => 6,
                'title' => '📊 Blog Tools',
                'created_by' => 1,
            ],
            // [
            //     'id' => 7,
            //     'title' => '📦 z - Extras',
            //     'created_by' => 1,
            // ],
            [
                'id' => 8,
                'title' => '📧 E-mail Tools',
                'created_by' => 1,
            ],
            [
                'id' => 9,                
                'title' => '📱 Social Media Tools',
                'created_by' => 1,
            ],
            // [
            //     'id' => 10,
            //     'title' => '📷 Image Prompts',
            //     'created_by' => 1,
            // ],
            [
                'id' => 11,
                'title' => '📺 Youtube Tools',
                'created_by' => 1,
            ],
            [
                'id' => 12,
                'title' => '🔄 Re-Purpose Content',
                'created_by' => 1,
            ],
            [
                'id' => 13,
                'title' => '🔍 SEO Tools',
                'created_by' => 1,
            ],
            [
                'id' => 14,
                'title' => '🤖 Film Making Tools',
                'created_by' => 1,
            ],
            [
                'id' => 15,
                'title' => '🚀 Advertising Tools',
                'created_by' => 1,
            ],
            [
                'id' => 16,
                'title' => 'Storytelling',
                'created_by' => 1,
            ],
            // [
            //     'id' => 17,
            //     'title' => 'Logo Tools',
            //     'created_by' => 1,
            // ],
            [
                'id' => 18,
                'title' => 'Job Application Tools',
                'created_by' => 1,
            ],
            [
                'id' => 19,
                'title' => 'Productivity Tools',
                'created_by' => 1,
            ],
            [
                'id' => 20,
                'title' => 'Creativity Tools',
                'created_by' => 1,
            ],
            // [
            //     'id' => 21,
            //     'title' => 'DevOps Tools',
            //     'created_by' => 1,
            // ],
            // [
            //     'id' => 22,
            //     'title' => 'Generative-AI',
            //     'created_by' => 1,
            // ],
            [
                'id' => 23,
                'title' => 'Marketing Tools',
                'created_by' => 1,
            ],
            // [
            //     'id' => 24,
            //     'title' => 'Operating System Tools',
            //     'created_by' => 1,
            // ],
            // [
            //     'id' => 25,
            //     'title' => 'Productivity Tools',
            //     'created_by' => 1,
            // ],
            [
                'id' => 26,
                'title' => 'SaaS Tools',
                'created_by' => 1,
            ],
            // [
            //     'id' => 27,
            //     'title' => 'Software Engineering Tools',
            //     'created_by' => 1,
            // ],
            // [
            //     'id' => 28,
            //     'title' => 'Crypto',
            //     'created_by' => 1,
            // ],
            // [
            //     'id' => 29,
            //     'title' => '300',
            //     'created_by' => 1,
            // ],
            // [
            //     'id' => 30,
            //     'title' => 'Other',
            //     'created_by' => 1,
            // ],
            [
                'id' => 31,
                'title' => 'Image Tools',
                'created_by' => 1,
            ],
        ];

        foreach ($categories as $row) {
            Category::create($row);
        }
    }
}