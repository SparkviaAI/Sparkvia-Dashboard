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
                'id' => 1,
                'question' => 'Whats your story topic?',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 10,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 2,
                'question' => 'Whats your preferred language?',
                'type' => 'single_select',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => ['English;German;Spanish;French;Dutch'],
                'created_by' => 1,
            ],
            
            [
                'id' => 3,
                'question' => 'Language',
                'type' => 'single_select',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => ['English;Frensh;Spanish'],
                'created_by' => 1,
            ],
            
            [
                'id' => 4,
                'question' => 'Tone',
                'type' => 'single_select',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => ['Default;Confident;Formal'],
                'created_by' => 1,
            ],
            
            [
                'id' => 5,
                'question' => 'Writing style',
                'type' => 'single_select',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => ['Default;Academic;Analytical'],
                'created_by' => 1,
            ],
            
            [
                'id' => 6,
                'question' => 'product name',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 7,
                'question' => 'product description',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 8,
                'question' => 'describe your product / service',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 9,
                'question' => 'your target location',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 10,
                'question' => 'describe your business',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 11,
                'question' => 'what are you selling or promoting? (include key features of your product or service)',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 12,
                'question' => 'enter your focus keyword',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 13,
                'question' => 'what is the advertising goal of the ad?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 14,
                'question' => 'who is the target audience for the ad?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 15,
                'question' => 'product/brand name',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 16,
                'question' => 'who is your target audience ?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 17,
                'question' => 'enter your keyword(s)',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 18,
                'question' => 'enter your blog topic.',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 19,
                'question' => 'enter your blog outline here.',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 20,
                'question' => 'what is your blog title?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 21,
                'question' => 'enter minimum words',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 22,
                'question' => 'enter your focus keyword(s)',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 23,
                'question' => 'enter your target keyword',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 24,
                'question' => 'enter your existing article',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 25,
                'question' => 'enter your second focus keyword',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 26,
                'question' => 'what type of content you want to create?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 27,
                'question' => 'who is your ideal customer? (describe their interests)',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 28,
                'question' => 'what is the unique selling points (usps) that differentiates your product or service from competitors?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 29,
                'question' => 'what action do you want the audience to take after engaging with your content?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 30,
                'question' => 'what problem does your product or service aim to solve for your customers?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 31,
                'question' => 'what results or benefits can customers expect from using your product or service?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 32,
                'question' => 'is there a specific story or narrative you want to incorporate into your content? (optional)',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 33,
                'question' => 'enter any customer testimonials that you want to incorporate into your content. (optional)',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 34,
                'question' => 'what action do you want the audience to take after engaging with your content?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 35,
                'question' => 'what are the key needs / desires of your customer that your product or service fulfils?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 36,
                'question' => 'specify the theme (or the main topic )for this newsletter.',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 37,
                'question' => '1 what is the 1st update or topic you want to cover in the newsletter?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 38,
                'question' => '2 what is the 2nd update or topic you want to feature in the newsletter?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 39,
                'question' => '3 what is the 3rd update or topic you want to feature in the newsletter?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 40,
                'question' => 'could you list the subtopics you want to include in the newsletter?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 41,
                'question' => 'how many words should be allocated for each topic within the newsletter?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 42,
                'question' => 'what are the specific purposes and goals of this newsletter?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 43,
                'question' => 'what is the desired word count for the entire newsletter?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 44,
                'question' => 'enter maximum words',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 45,
                'question' => 'what is the genre of the film?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 46,
                'question' => 'what is the film style?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 47,
                'question' => 'duration of the film',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 48,
                'question' => 'add your one-line story',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 49,
                'question' => 'enter your video script.',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 50,
                'question' => 'what is the desired duration of your trailer?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 51,
                'question' => 'what subject do you want to have in the image?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 52,
                'question' => 'what action should the subject be doing?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 53,
                'question' => 'what is the time and day of the environment?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 54,
                'question' => 'which art form to use? (photography, illustration, watercolor, oil painting, comics, pixar 3d, digital illustration, artwork, paperwork, 3d, etc)',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 55,
                'question' => 'is the concept, theme or idea for the song lyrics?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 56,
                'question' => 'what genre do you want for your song?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 57,
                'question' => 'how many verses would you like in the song?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 58,
                'question' => 'how would you like the overall mood or emotion of the song to feel?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 59,
                'question' => 'enter your whole article below',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 60,
                'question' => 'enter your blog post or article',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 61,
                'question' => 'enter your video transcript',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 62,
                'question' => 'provide the youtube video transcript',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 63,
                'question' => 'enter your keyword(s)',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 64,
                'question' => 'number of titles you need?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 65,
                'question' => 'describe niche',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 66,
                'question' => 'what is your quora question ?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 67,
                'question' => 'what is your post about?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 68,
                'question' => 'enter your keyword here to get a list of hidden facts.',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 69,
                'question' => 'how many facts do you want?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 70,
                'question' => 'what is your profile about?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 71,
                'question' => 'title of the post',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 72,
                'question' => 'what are the social medias ?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 73,
                'question' => 'describe what your website or app is about?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 74,
                'question' => 'enter the tld or extention you want (like .com, in. .ai, .org)',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 75,
                'question' => 'what service(s) do you provide?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 76,
                'question' => 'no. of words for each service',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 77,
                'question' => 'enter the content of your website',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 78,
                'question' => 'enter your text to add emojis.',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 79,
                'question' => 'enter the text you want to summarize',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 80,
                'question' => 'enter the text that you want to re-write or improve.',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 81,
                'question' => 'what is your channel about ?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 82,
                'question' => 'enter your video title & the points you want to cover?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 83,
                'question' => 'enter your video script with timestamps.',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 84,
                'question' => 'enter your title or points you want to cover in your video',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 85,
                'question' => 'enter maximum words',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 86,
                'question' => 'what are the details of the job you are applying for?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 87,
                'question' => 'what are your qualifications?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 88,
                'question' => 'what skills and experience do you have that align with the job requirements and the companys goals?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 89,
                'question' => 'what are the companys goals as stated in the job description?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 90,
                'question' => 'role',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 91,
                'question' => 'company name',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 92,
                'question' => 'what does it do?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 93,
                'question' => 'requirements',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 94,
                'question' => 'Input keyword or title here',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 95,
                'question' => 'Competitor url',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 96,
                'question' => 'Keyword',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 97,
                'question' => 'Title or keyword',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 98,
                'question' => 'Main keyword',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 99,
                'question' => 'Article title',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 100,
                'question' => 'Insert the blog post here',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 101,
                'question' => 'Insert original article here',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 102,
                'question' => 'Provide the article title you desire. he aims to write an extensive and thorough article',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 103,
                'question' => 'Subject for the book you want to write',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 104,
                'question' => 'changing a tire, discovering the himalayas,  dog training for newbies, etc',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 105,
                'question' => 'Paste your content here to make it unique',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 106,
                'question' => 'Subject prompt',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 107,
                'question' => 'Input the keywords to generate titles',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 108,
                'question' => 'Input the main keyword for content creation',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 109,
                'question' => 'Input one descriptive product name',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 110,
                'question' => 'Please copy and paste the entire page content here',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 111,
                'question' => 'Information keyword',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 112,
                'question' => 'Primary keyword',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 113,
                'question' => 'Input title or topic',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 114,
                'question' => 'Express your concept here',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 115,
                'question' => 'Input instagram carousel topic',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 116,
                'question' => 'Question about python',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 117,
                'question' => 'Your code question (ex: using three.js to create a cube animation)',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 118,
                'question' => 'Input keyword',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 119,
                'question' => 'Provide the instagram post subject (include specifics such as the content of the reel, image, or carousel)',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 120,
                'question' => 'Image description',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 121,
                'question' => 'Input business name is a business type. for instance: smiths bakery is a bread and pastry store',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 122,
                'question' => 'Input course name. for example: how to do a seo optimization on a website',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 123,
                'question' => 'Where do your clients come from and what does your business sell',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 124,
                'question' => 'Please provide the content that you wish to convert',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 125,
                'question' => 'Example: a portable generator, garage door repair',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 126,
                'question' => 'Target text for meta description',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 127,
                'question' => 'Target content',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 128,
                'question' => 'Please provide a list of features, keywords, and any other information related to the product',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 129,
                'question' => 'The website link that you want to be analyzed',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 130,
                'question' => '2. specify the topic or keyword related to your query, including the option to provide a relevant video topic or youtube video title',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 131,
                'question' => '3. summarize the topic or keyword in a few words',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 132,
                'question' => 'Target audience, campaign goals, and product or service',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 133,
                'question' => 'The main text or content for which you want a description',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 134,
                'question' => 'Quora question',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 135,
                'question' => 'Title',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 136,
                'question' => 'Target audience: xxx,  keywords: xxx',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 137,
                'question' => 'Your task',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 138,
                'question' => 'Blog title',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 139,
                'question' => 'Content paste here',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 140,
                'question' => 'Short description',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 141,
                'question' => 'State the business name, location, type of products or services offered',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 142,
                'question' => 'Kindly provide the text you would like me to rephrase, with a maximum of around 8000 characters.',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 143,
                'question' => 'What you need help with',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 144,
                'question' => 'Example: the targeted keywords for joes pizza, a pizza shop in nyc, are pizza slice and best pizza in nyc',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 145,
                'question' => 'Provide a complete sentence that includes a request for assistance, such as i require aid in devising an advertising strategy aimed towards students, promoting a new type of coffee.',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 146,
                'question' => 'Youtube title',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 147,
                'question' => 'Keyword and key benefits',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 148,
                'question' => 'Whats the promotion, target audience, and primary advantage?',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 149,
                'question' => 'Target keywords',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 150,
                'question' => 'Topic/keyword',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 151,
                'question' => 'List of keywords',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 152,
                'question' => 'Post title',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 153,
                'question' => 'Ms excel query',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 154,
                'question' => 'Include any desired keyword to create a stunning look, such as a girl wearing an outfit',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 155,
                'question' => 'Keyword or description of what you want to build',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 156,
                'question' => 'Search keywords, such as seo',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 157,
                'question' => 'Question',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 158,
                'question' => 'Topic',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 159,
                'question' => 'Website link',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 160,
                'question' => 'Youtube transcript',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 161,
                'question' => 'Past code here',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 162,
                'question' => 'Keywords of the image',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 163,
                'question' => 'Topic or keywords',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 164,
                'question' => 'Brief summary/keywords of your article',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 165,
                'question' => 'Outlines or chapter structures',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 166,
                'question' => 'Choose a topic for your linkedin post',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 167,
                'question' => 'Java related question',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 168,
                'question' => 'Paste the article you want to share',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 169,
                'question' => 'Enter the text you want to translate',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 170,
                'question' => 'Content for which you want to receive comments',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 171,
                'question' => 'Keywords for image',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 172,
                'question' => 'Name and location of the business',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 173,
                'question' => 'Provide a description of the product or service you offer',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 174,
                'question' => 'Book topic',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 176,
                'question' => 'Specify your profession or area of expertise',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 177,
                'question' => 'Your topic of interest',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 178,
                'question' => 'The primary keyword for your image',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 179,
                'question' => 'Html related question',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 180,
                'question' => 'The primary keyword',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 181,
                'question' => 'Elaborate on your idea and the programming language',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 182,
                'question' => 'Input article title and keyword',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 183,
                'question' => 'Input article title',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 184,
                'question' => 'Describe',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 185,
                'question' => 'Target url + target content',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 186,
                'question' => 'Question regarding php',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 187,
                'question' => 'Javascript related question',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 188,
                'question' => 'Question about react',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 189,
                'question' => 'Choose a topic for your linkedin post',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 190,
                'question' => 'Category short description',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 191,
                'question' => 'Question about google sheets',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            
            [
                'id' => 192,
                'question' => 'Category and target customer description',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 193,
                'question' => 'Competitors link',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 194,
                'question' => 'Docker related question',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 195,
                'question' => 'Question about linux',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 196,
                'question' => 'List of keywords',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 197,
                'question' => 'Question about mysql',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 198,
                'question' => 'Question about windows',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 199,
                'question' => 'Question about typescript',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 200,
                'question' => 'Category and target customer description',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 201,
                'question' => 'Question about salesforce',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 202,
                'question' => 'Category and target audience description',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 203,
                'question' => 'Golang question',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 204,
                'question' => 'Ansible question',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 205,
                'question' => 'Question on postgresql',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 206,
                'question' => 'Question regarding visual studio code',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 207,
                'question' => 'Brand and target audience description',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 208,
                'question' => 'Query about git',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 209,
                'question' => 'Question regarding your macos',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 210,
                'question' => 'Vue question',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 211,
                'question' => 'Phrase to change to spintax',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 212,
                'question' => 'Quickbooks question',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 213,
                'question' => 'Input the url of the webpage',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 214,
                'question' => 'Email conversation text with your customer',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 215,
                'question' => 'Your code',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 216,
                'question' => 'Enhance my prompt',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 217,
                'question' => 'Refund policy and email conversations with your customer',
                'type' => 'multi_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 218,
                'question' => 'Adobe suite question',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 219,
                'question' => 'Target link',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 220,
                'question' => 'Place the main keyword for which you want to develop content',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 221,
                'question' => 'Question about rust',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 222,
                'question' => 'Target url',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 223,
                'question' => 'Your xero inquiry',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 224,
                'question' => 'Questions on vim',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 225,
                'question' => 'Your slender inquiry',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 226,
                'question' => 'Insert your client evaluation here',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 227,
                'question' => 'Stripe api inquiry',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 228,
                'question' => 'Linkedin post idea',
                'type' => 'single_line',
                'is_required' => 'required',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 229,
                'question' => 'What is your story title?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
            
            [
                'id' => 230,
                'question' => 'What is story language?',
                'type' => 'multi_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],

            [
                'id' => 231,
                'question' => 'What art form or style do you prefer?(Photography, Illustration, Watercolor, Oil Painting, Digital Art, Comics, Pixar 3D, etc.)',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],

            [
                'id' => 232,
                'question' => 'What mood or emotion should the image convey?(e.g., joyful, mysterious, eerie, romantic, adventurous, calm)',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],

            [
                'id' => 233,
                'question' => 'Are there any specific references or inspirations for this image?',
                'type' => 'single_line',
                'is_required' => 'optional',
                'minimum_answer_length' => 0,
                'options' => [],
                'created_by' => 1,
            ],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}

