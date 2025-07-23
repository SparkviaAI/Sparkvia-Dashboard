<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Prompt;

class PromptSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::get();

        if ($categories->isEmpty()) {
            throw new \Exception("No categories found");
        }

        $prompts = [
            // Story telling
            [
                'title' => 'Write a story',
                'description' => 'Write a story for any topic in seconds.',
                'type' => 'text',
                'prompt' => 'Write a short story about [Q_1] in [Q_2]',
                'category_id' => $categories->where('title', Category::TYPE_STORYTELLING)->first()->id,
                'created_by' => 1,
                'engine_id' => 2,

            ],

            // Blog tools
            [
                'title' => 'Blog ideas',
                'description' => 'Get inspiration for your next blog post with a collection of creative blog ideas. Write engaging content with ease.',
                'type' => 'text',
                'prompt' => 'Product/Brand name: {{answer_1}}, Product description: {{answer_2}}, Tone: {{tone}}. Generate creative and attention-grabbing blog ideas with the above information and tone',
                'category_id' => $categories->where('title', Category::TYPE_BLOG_TOOLS)->first()->id,
                'created_by' => 1,
                'engine_id' => 2,
            ],
            [
                'title' => 'Blog intro',
                'description' => 'Craft a captivating introduction for your blog that sets the tone and hooks your readers.',
                'type' => 'text',
                'prompt' => 'Blog title: {{answer_1}}, About Blog: {{answer_2}}, Tone: {{tone}}. Write a catchy and engaging introduction for a blog post with the above information and tone. The introduction should briefly explain the topic of the blog and grab the reader\'s attention.',
                'category_id' => $categories->where('title', Category::TYPE_BLOG_TOOLS)->first()->id,
                'created_by' => 1,
                'engine_id' => 2,
            ],
            [
                'title' => 'Keyword generator',
                'description' => 'Boost your search engine optimization (SEO) by discovering keywords that are relevant to your content.',
                'type' => 'text',
                'prompt' => 'Topic: {{answer_1}}, Tone: {{tone}}. Generate keyword suggestions for a blog post on the topic above and tone',
                'category_id' => $categories->where('title', Category::TYPE_BLOG_TOOLS)->first()->id,
                'created_by' => 1,
                'engine_id' => 11,
            ],

            // E-Commerce
            [
                'title' => 'Product description',
                'description' => 'Create compelling product descriptions that highlight the features and benefits of your offerings.',
                'type' => 'text',
                'prompt' => 'Product name: {{answer_1}}, Product description: {{answer_2}}, Tone: {{tone}}. Generate a persuasive product description with the above information and tone, make sure to highlight the unique features and benefits of the product and convince the reader to purchase.',
                'category_id' => $categories->where('title', Category::TYPE_E_COMMERCE)->first()->id,
                'created_by' => 1,
                'engine_id' => 11,
            ],
            [
                'title' => 'Short text hook',
                'description' => 'Write attention-grabbing text hooks that grab the reader\'s attention and make them want to read on.',
                'type' => 'text',
                'prompt' => 'Product description: {{answer_1}}, Tone: {{tone}}. Generate a short text hook with the above information and tone, it should be attention-grabbing and persuasive.',
                'category_id' => $categories->where('title', Category::TYPE_E_COMMERCE)->first()->id,
                'created_by' => 1,
                'engine_id' => 1,
            ],

            //Social media tools
            [
                'title' => 'YouTube video ideas',
                'description' => 'Generate ideas for your next YouTube video, from vlogs to tutorials to unboxings.',
                'type' => 'text',
                'prompt' => 'Product description: {{answer_1}}, Tone: {{tone}}. Generate YouTube video ideas with the above information and tone, be creative and consider current trends and successful videos in this field.',
                'category_id' => $categories->where('title', Category::TYPE_SOCIAL_MEDIA_TOOLS)->first()->id,
                'created_by' => 1,
                'engine_id' => 1,
            ],
            [
                'title' => 'Instagram captions',
                'description' => 'Write eye-catching captions for your Instagram posts that engage your followers and improve your visibility.',
                'type' => 'text',
                'prompt' => 'Post details: {{answer_1}}, Tone: {{tone}}. Write a creative and trendy Instagram captions with the above information and tone',
                'category_id' => $categories->where('title', Category::TYPE_SOCIAL_MEDIA_TOOLS)->first()->id,
                'created_by' => 1,
                'engine_id' => 1,
            ],
            [
                'title' => 'Hashtag generator',
                'description' => 'Discover popular hashtags related to your niche to help your content reach a wider audience.',
                'type' => 'text',
                'prompt' => 'Post details: {{answer_1}}, Tone: {{tone}}. Generate hashtags for a social media post with the above information and tone, be creative and trendy, capturing the attention of the target audience.',
                'category_id' => $categories->where('title', Category::TYPE_SOCIAL_MEDIA_TOOLS)->first()->id,
                'created_by' => 1,
                'engine_id' => 1,
            ],

            // Digital ad copy
            [
                'title' => 'Ad copy variants',
                'description' => 'Create multiple variations of your ad copy to test and optimize the performance of your advertising campaigns.',
                'type' => 'text',
                'prompt' => 'Product/Brand name: {{answer_1}}, Product description: {{answer_2}}, Tone: {{tone}}. Generate 5 ad copy variants for a social media or advertising campaign with the above information and tone, be creative and trendy, capturing the attention of the target audience.',
                'category_id' => $categories->where('title', Category::TYPE_DIGITAL_AD_COPY)->first()->id,
                'created_by' => 1,
                'engine_id' => 1,
            ],
            [
                'title' => 'General Ad copy',
                'description' => 'Write persuasive ad copy that converts potential customers into paying customers.',
                'type' => 'text',
                'prompt' => 'Product/Brand name: {{answer_1}}, Product description: {{answer_2}}, Tone: {{tone}}. Write ad copy for a social media or advertising campaign with the above information and tone, be creative and trendy, capturing the attention of the target audience.',
                'category_id' => $categories->where('title', Category::TYPE_DIGITAL_AD_COPY)->first()->id,
                'created_by' => 1,
                'engine_id' => 2,
            ],

            // Brainstorming tools
            [
                'title' => 'Name generator',
                'description' => 'Find unique and memorable names for your business, product, or brand.',
                'type' => 'text',
                'prompt' => 'Product description: {{answer_1}}, Tone: {{tone}}. Generate 5 creative and trendy names for a product with the above information and tone. Consider the product\'s purpose, target audience, and branding when creating the names.',
                'category_id' => $categories->where('title', Category::TYPE_BRAINSTORMING_TOOLS)->first()->id,
                'created_by' => 1,
                'engine_id' => 2,
            ],
            [
                'title' => 'Startup ideas',
                'description' => 'Get inspired and explore new business opportunities with a collection of innovative startup ideas.',
                'type' => 'text',
                'prompt' => 'I\'m passionate about: {{answer_1}}, Tone: {{tone}}. Generate 5 creative and innovative startup ideas that align with my passions with the above information and tone.',
                'category_id' => $categories->where('title', Category::TYPE_BRAINSTORMING_TOOLS)->first()->id,
                'created_by' => 1,
                'engine_id' => 2,
            ],

            // Personal tools
            [
                'title' => 'Love letter',
                'description' => 'Write a heartfelt love letter to express your feelings to your significant other.',
                'type' => 'text',
                'prompt' => 'For: {{answer_1}}, Occasion: {{answer_2}}, Tone: {{tone}}. Write a romantic love letter, capturing your feelings and emotions towards them with the above information and tone, while incorporating words and phrases that evoke a romantic and influential tone.',
                'category_id' => $categories->where('title', Category::TYPE_PERSONAL_TOOLS)->first()->id,
                'created_by' => 1,
                'engine_id' => 1,
            ],
            [
                'title' => 'Cover letter',
                'description' => 'Write a compelling cover letter that showcases your skills and lands you your dream job.',
                'type' => 'text',
                'prompt' => 'Role: {{answer_1}}, Experience: {{answer_2}}, Tone: {{tone}}. Write a cover letter for a role with the above information and tone, mentioning my experience. Please make the tone professional and persuasive.',
                'category_id' => $categories->where('title', Category::TYPE_PERSONAL_TOOLS)->first()->id,
                'created_by' => 1,
                'engine_id' => 2,
            ],

            // Images
            [
                'title' => 'Oil painting',
                'description' => 'Replicate the look of a traditional oil painting on any image.',
                'type' => 'image',
                'prompt' => 'Generate an oil painting-style image of {{answer_1}}.',
                'category_id' => $categories->where('title', Category::TYPE_IMAGES)->first()->id,
                'created_by' => 1,
                'engine_id' => 1,
            ],
            [
                'title' => 'Watercolor',
                'description' => 'Add a watercolor effect to give images a dreamy, whimsical look.',
                'type' => 'image',
                'prompt' => 'Generate a watercolor-style image of {{answer_1}}.',
                'category_id' => $categories->where('title', Category::TYPE_IMAGES)->first()->id,
                'created_by' => 1,
                'engine_id' => 1,
            ],
            [
                'title' => 'Sketch',
                'description' => 'Create a sketch-like effect to make images appear hand-drawn.',
                'type' => 'image',
                'prompt' => 'Generate a sketch-style image of {{answer_1}}.',
                'category_id' => $categories->where('title', Category::TYPE_IMAGES)->first()->id,
                'created_by' => 1,
                'engine_id' => 2,
            ],
            [
                'title' => 'Pop art',
                'description' => 'Add a pop art twist to images with bold colors and patterns.',
                'type' => 'image',
                'prompt' => 'Generate a pop art style image of {{answer_1}}.',
                'category_id' => $categories->where('title', Category::TYPE_IMAGES)->first()->id,
                'created_by' => 1,
                'engine_id' => 2,
            ],
        ];

        foreach ($prompts as $data) {
            Prompt::create($data);
        }
    }
}
