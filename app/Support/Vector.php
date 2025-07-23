<?php

namespace App\Support;

use App\Exceptions\ChatBotFailedException;
use App\Models\ChatBot;
use App\Traits\ToolsTrait;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

class Vector
{
    use ToolsTrait;

    public function saveVector(array $documentEmbedding, $text, $chatBot, $vector_id = null): string
    {
        try {
            $url = config('services.pinecone.url') . "/vectors/upsert";
            $vector_id = $vector_id ?? Uuid::uuid4()->toString();
            $data = [
                'vectors' => [
                    "id" => $vector_id,
                    "values" => $documentEmbedding,
                    "metadata" => [
                        "text" => $text,
                        "chat_bot_id" => $chatBot->id,
                        "user_id" => $chatBot->user_id,
                        "tenant_id" => $chatBot->tenant_id,
                    ]
                ]
            ];
            $headers = [
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                "Api-Key: " . config('services.pinecone.api_key')
            ];
            $result = callAPI($url, $headers, $data, 'POST');

            if (!$result) {
                throw new ChatBotFailedException(trans('global.missing_pinecone'), Response::HTTP_BAD_REQUEST);
            }
            return $result->upsertedCount ? $vector_id : '';
        } catch (\Exception  $e) {
            throw new ChatBotFailedException($e->getMessage(), $e->getCode());
        }
    }

    public function searchVector($question, int $limit, int $chatBot_Id): string
    {
        $embedding[] = $this->generateEmbedding($question);
        try {
            $url = config('services.pinecone.url') . "/query";
            $data = [
                'vector' => $embedding,
                'topK' => $limit ?? 100,
                'includeValues' => false,
                'includeMetadata' => true,
                'filter' => [
                    "tenant_id" => ['$eq' => auth()->user()->current_tenant_id],
                    "user_id" => ['$eq' => auth()->user()->id],
                    "chat_bot_id" => ['$eq' => $chatBot_Id],
                ]
            ];

            $headers = [
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                "Api-Key: " . config('services.pinecone.api_key')
            ];

            $result = callAPI($url, $headers, $data, 'POST');

            $matches = '';
            if ($result && count($result->matches)) {
                foreach ($result->matches as $match) {
                    $matches .= is_array($match->metadata->text) ? (Arr::join($match->metadata->text, ',') ?? '')
                        : $match->metadata->text ?? '' . " ";
                }
            }
            return $matches;
        } catch (\Exception  $e) {
            throw new ChatBotFailedException($e->getMessage(), $e->getCode());
        }
    }

    public function deleteVector($id): bool
    {
        try {
            $url = config('services.pinecone.url') . "/vectors/delete";
            $data = ['ids' => $id];

            $headers = [
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                "Api-Key: " . config('services.pinecone.api_key')
            ];

            $result = callAPI($url, $headers, $data, 'DELETE');
            if ($result) {
                return true;
            }
            return false;
        } catch (\Exception  $e) {
            throw new ChatBotFailedException($e->getMessage(), $e->getCode());
        }
    }

    public function chunkText($text, $chatBot)
    {
        $words = str_word_count($text, 1, "0123456789:,;./_'"); // Convert text into an array of words
        $chunks = array_chunk($words, ChatBot::CHUNK_OF_WORDS); // Split the array into chunks of 200 words each

        $result = [];
        foreach ($chunks as $chunk) {
            $sub_text = implode(' ', $chunk);
            $embedding = $this->generateEmbedding($sub_text);
            $vector_id = $this->saveVector($embedding, $sub_text, $chatBot);
            array_push($result, $vector_id);
        }
        return $result;
    }
}
