<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ChatBot;
use App\Repository\ChatBot\ChatBotRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

final class ChatBotServiceImpl implements ChatBotService
{
    /**
     * @var \App\Repository\ChatBot\ChatBotRepository
     */
    private ChatBotRepository $chatBotRepository;

    public function __construct(ChatBotRepository $chatBotRepository)
    {
        $this->chatBotRepository = $chatBotRepository;
    }

    public function getAllChatBots(): Collection
    {
        return $this->chatBotRepository->all();
    }

    public function findById(int $chatBotId): ChatBot
    {
        return $this->chatBotRepository->find($chatBotId);
    }

    public function createChatBot(Request $request)
    {
        return $this->chatBotRepository->createChatBot($request);
    }

    public function updateChatBot(Request $request, ChatBot $chatBot)
    {
        return $this->chatBotRepository->updateChatBot($request, $chatBot);
    }

    public function deleteChatBot(ChatBot $chatBot): bool
    {
        return $this->chatBotRepository->deleteChatBot($chatBot);
    }
}
