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
                'title' => Category::TYPE_BLOG_TOOLS,
                'created_by' => 1,
            ],
            [
                'title' => Category::TYPE_E_COMMERCE,
                'created_by' => 1,
            ],
            [
                'title' => Category::TYPE_SOCIAL_MEDIA_TOOLS,
                'created_by' => 1,
            ],
            [
                'title' => Category::TYPE_DIGITAL_AD_COPY,
                'created_by' => 1,
            ],
            [
                'title' => Category::TYPE_BRAINSTORMING_TOOLS,
                'created_by' => 1,
            ],
            [
                'title' => Category::TYPE_PERSONAL_TOOLS,
                'created_by' => 1,
            ],
            [
                'title' => Category::TYPE_IMAGES,
                'created_by' => 1,
            ],
            [
                'title' => Category::TYPE_STORYTELLING,
                'created_by' => 1,
            ],
        ];

        foreach ($categories as $row) {
            Category::create($row);
        }
    }
}


