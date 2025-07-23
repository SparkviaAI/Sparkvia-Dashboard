<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ChatBot;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface ChatBotService
{
    public function getAllChatBots(): Collection;

    public function findById(int $chatBotId): ChatBot;

    public function createChatBot(Request $request);

    public function updateChatBot(Request $request, ChatBot $chatBot);

    public function deleteChatBot(ChatBot $chatBot): bool;
}
