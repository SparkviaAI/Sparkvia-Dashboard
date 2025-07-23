<?php
// phpcs:ignoreFile
namespace App\Traits;

ini_set('max_execution_time', 180); //3 minutes

use App\Exceptions\ChatBotFailedException;
use App\Exceptions\GenerateContentFailedException;
use App\Exceptions\GenerateImageFailedException;
use App\Models\Chat;
use App\Models\ChatBot;
use App\Models\Engine;
use App\Models\Prompt;
use App\Support\Scrape;
use App\Support\Vector;
use App\Utils\Settings;
use Illuminate\Http\Request;
use OpenAI;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Exceptions\TransporterException;
use Symfony\Component\HttpFoundation\Response;
use TikToken\Encoder;

trait ToolsTrait
{


    private function customCurlRequest($url, $headers = [], $postFields = null) {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, $postFields !== null);
        if ($postFields !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Disable SSL host verification

        $response = curl_exec($ch);
        $error = curl_error($ch);

        curl_close($ch);

        if ($error) {
            throw new \Exception("cURL error: $error");
        }

        return $response;
    }



    public function generate(Request $request)
    {
        $prompt = Prompt::find($request->get('prompt_id'));
        $questionIds = $prompt->questions->pluck('id');
        // loop on questions and map it to answers
        $answers = $questionIds->mapWithKeys(function ($id, $index) use ($request) {
            $answer = $request->get('question_' . $id) ?? "";
            return ['Q_' . $id => $answer];
        });

        $links = $questionIds->mapWithKeys(function ($id) use ($request) {
            $answer = $request->get('question_' . $id) ?? "";
            if ($request->get('question_type_' . $id) == 'live_crawling') {
                return [$answer];
            }
            return [];
        });

        $modifiedPrompt = preg_replace_callback('/\[(\w+)\]/', function ($match) use ($answers) {
            $key = $match[1];
            return $answers[$key] ?? '';
        }, $prompt->prompt);

        if ($prompt->isText) {
            return $this->makeRequest($modifiedPrompt, $prompt->max_tokens, $prompt->engine, $prompt->chat_bot_id, $links);
        } elseif ($prompt->isImage) {
            return $this->makeImageRequest($modifiedPrompt);
        } else {
            throw new \InvalidArgumentException('Invalid prompt: ' . $prompt->id);
        }
    }

    private function makeRequest(string $prompt, ?int $promptMaxTokens, ?Engine $promptEngine, $chatBotId, $links)
    {
        $apiKey = getSettingByKey(Settings::OPENAI_API_KEY);
        $maxTokens = $promptMaxTokens ?: getSettingByKey(Settings::DEFAULT_MAX_TOKENS) ?: 500;

        $defaultEngine = Engine::find(getSettingByKey(Settings::ENGINE_ID));
        $engine = $promptEngine ?: $defaultEngine ?: Engine::firstOrFail();

        if (!$apiKey) {
            throw new GenerateContentFailedException(trans('content.openai_api_key_empty'), Response::HTTP_CONTINUE);
        }

        $client = OpenAI::client($apiKey);
        if ($this->getToken($prompt) >= $engine->max_tokens)
            throw new GenerateContentFailedException(trans('content.prompt_exceed_max_token'), 400);

        $helper = '';
        $limit = $this->tokenize($prompt, $engine->max_tokens);
        if ($chatBotId > 0) {
            $vector = new Vector();

            $helper = $vector->searchVector($prompt, $limit, $chatBotId);
        }

        $helper .= $this->preparePromptLinks($links, $limit);
        if (!empty($helper)) {
            $prompt = $this->prepareChatHelper($helper, $prompt);
        }

        if ($engine->is_chat) {
            try {
                return $client->chat()->createStreamed([
                    'model' => $engine->value,
                    'messages' => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                ]);
            } catch (TransporterException  $e) {
                throw new GenerateContentFailedException(trans('global.general_error'), $e->getPrevious()->getCode());
            }
        }

        try {
            return $client->completions()->createStreamed([
                'model' => $engine->value,
                'prompt' => $prompt,
                "max_tokens" => $maxTokens
            ]);
        } catch (TransporterException  $e) {
            throw new GenerateContentFailedException(trans('global.general_error'), $e->getPrevious()->getCode());
        }
    }

    private function makeChatRequest(string $prompt, Chat $chat)
    {
        $apiKey = getSettingByKey(Settings::OPENAI_API_KEY);
        $engine = Engine::find(getSettingByKey(Settings::CHAT_ENGINE_ID)) ?: Engine::where('value', Engine::GPT_35TURBO_16K)->firstOrFail();

        if (!$apiKey) {
            throw new GenerateContentFailedException(trans('content.openai_api_key_empty'), Response::HTTP_CONTINUE);
        }

        $client = OpenAI::client($apiKey);

        if ($this->getToken($prompt) >= $engine->max_tokens)
            throw new GenerateContentFailedException(trans('content.prompt_exceed_max_token'), 400);

        if ($chatBotId = getSettingByKey(Settings::CHAT_CHAT_BOT_ID)) {
            $vector = new Vector();
            $limit = $this->tokenize($prompt, $engine->max_tokens);
            $helper = $vector->searchVector($prompt, $limit, $chatBotId);

            if (!empty($helper)) {
                $prompt = $this->prepareChatHelper($helper, $prompt);
            }
        }

        try {
            $result = $client->chat()->createStreamed([
                'model' => $engine->value,
                'messages' => $this->mapChatMessages($chat)->push(['role' => 'user', 'content' => $prompt])->all()
            ]);
        } catch (TransporterException  $e) {
            throw new GenerateContentFailedException(trans('global.general_error'), $e->getPrevious()->getCode());
        }

        return $result;
    }


    private function mapChatMessages(Chat $chat)
    {
        return $chat->messages->map(function ($message) {
            return [
                'role' => $message->role,
                'content' => $message->content,
            ];
        });
    }

    private function makeImageRequest(string $prompt): string
    {
        $apiKey = getSettingByKey(Settings::OPENAI_API_KEY);
        if (!$apiKey) {
            throw new GenerateImageFailedException(trans('content.openai_api_key_empty'), Response::HTTP_CONTINUE);
        }

        // $client = OpenAI::client($apiKey);
        $url = "https://api.openai.com/v1/images/generations"; // Adjust URL for your specific API endpoint
        $headers = [
            "Authorization: Bearer $apiKey",
            "Content-Type: application/json"
        ];
        $postFields = json_encode([
            'prompt' => $prompt,
            'n' => 1,
            "size" => "1024x1024"
        ]);

        try {
            $result = $this->customCurlRequest($url, $headers, $postFields);
            $resultData = json_decode($result, true);
            return $resultData['data'][0]['url'];
        } catch (\Exception $e) {
            dd($e);
            // throw new GenerateImageFailedException($e->getMessage(), $e->getCode());
        }

        // try {
        //     $result = $client->images()->create([
        //         'prompt' => $prompt,
        //         'n' => 1,
        //         "size" => "1024x1024"
        //     ]);
        // } catch (ErrorException  $e) {
        //     throw new GenerateImageFailedException($e->getErrorMessage(), (int)$e->getErrorCode());
        // }
        // return $result['data'][0]['url'];
    }


    public function generateEmbedding($question): array
    {
        $apiKey = getSettingByKey(Settings::OPENAI_API_KEY);
        if (!$apiKey) {
            throw new ChatBotFailedException(trans('content.openai_api_key_empty'), Response::HTTP_CONTINUE);
        }
        $client = OpenAI::client($apiKey);
        try {
            $result = $client->embeddings()->create([
                'model' => 'text-embedding-ada-002',
                'input' => $question,
            ]);

            if (count($result['data']) == 0) {
                throw new ChatBotFailedException(trans('content.generate_embedding_error'), Response::HTTP_CONTINUE);
            }

            return $result['data'][0]['embedding'];
        } catch (ErrorException  $e) {
            throw new ChatBotFailedException($e->getMessage(), $e->getCode());
        }
    }

    private function prepareChatHelper($helper, $question): string
    {
        $instructions = '  Instructions:';
        $instructions .= '- Don\'t start the response by "Based on the provided information"';
        $instructions .= '- Don\'t mention any information has been provided to answer this question';

        return "Info: $helper.$instructions, Question: $question Answer:  ";
    }

    private function preparePromptLinks($links, $limit): string
    {
        $response = '';
        $scrape = new Scrape();
        foreach ($links as $link) {
            $response .= $scrape->handle($link) . "   ";
        }

        $words = str_word_count($response, 1); // Convert text into an array of words
        $chunks = array_chunk($words, ChatBot::CHUNK_OF_WORDS); // Split the array into chunks of 200 words each

        $result = [];
        foreach ($chunks as $chunk) {
            $sub_text = implode(' ', $chunk);
            array_push($result, $sub_text);
        }

        $limit = count($result) > $limit ? $limit : count($result);

        $response = '';
        for ($i = 0; $i < $limit; $i++) {
            $response .= $result[$i];
        }
        return $response;
    }

    /*
     * 1 token ~= 4 chars in English
     * 1 token ~= ¾ words
     * 100 tokens ~= 75 words
     */
    public function tokenize($prompt, $max_token)
    {
        $promptTokens = $this->getToken($prompt);
        $remaining = $max_token - $promptTokens;

        $oneVector = round(100 * ChatBot::CHUNK_OF_WORDS / 50);

        return round($remaining / $oneVector);
    }

    public function getToken($prompt)
    {
        $encoder = new Encoder();
        $tokens = $encoder->encode($prompt);
        return count($tokens);
    }
}
