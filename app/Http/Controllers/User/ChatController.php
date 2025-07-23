<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Category;
use App\Models\Prompt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Traits\ToolsTrait;
use Symfony\Component\HttpFoundation\StreamedResponse;


class ChatController extends Controller
{

    use ToolsTrait;
    
    public function chatIndex(){
        $getUserDetails = Auth::guard('user')->user();
        $getChatId = Chat::where('user_id',$getUserDetails->id)->first();
        $getAllMessages = "";
        if(!empty($getChatId)){
            $getAllMessages = Message::where('chat_id',$getChatId->id)->where('role','assistant')->orderBy('id','DESC')->get();
        }
        return view('users.chat.index', compact('getUserDetails','getAllMessages'));
    }

    
    public function mainChat(){
        $getUserDetails = Auth::guard('user')->user();
        return view('users.chat.chat', compact('getUserDetails'));
    }


    public function chatStore(Request $request){
        // dd($request->all());

        $user = User::where('id',$request->userId)->first();
        $content = $request->chat_question;
        $chat = $user->chats()->firstOrCreate(['title' => Chat::DEFAULT]);
        // save input
        $chat->messages()->create([
            'role' => 'user',
            'content' => $content,
            'index' => 0,
            'finish_reason' => 'stop',
        ]);

        @ini_set('zlib.output_compression', 0);
        @ini_set('implicit_flush', 1);
        @ob_end_clean();
        set_time_limit(0);

        $aiContent = "";
        $letterCount = 0;
        $data = $this->makeChatRequest($content, $chat);

        foreach ($data as $item) {
            if ($item->choices[0]->delta->content != null) {
                // $aiContent .= $item->choices[0]->delta->content;
                // // Update letter count for new content only
                // $letterCount += str_word_count($aiContent);

                $newContent = $item->choices[0]->delta->content;
                $aiContent .= $newContent;
                // Update letter count for new content only
                $letterCount += str_word_count($newContent);
            }
            if ($item->choices[0]->finishReason == 'stop') {
                $this->saveMessage($user, $chat, $aiContent, $item->choices[0]->finishReason);
            }
        }
        $user->update([
            'chat_word_count' => $letterCount,
        ]);

        return view('users.chat.chat', ['content' => $aiContent, 'original_question' => $content]);


    }



    public function chatUpdate(Request $request)
    {
        $user = User::where('id', $request->userId)->first();
        $content = $request->question;
        $chat = $user->chats()->firstOrCreate(['title' => Chat::DEFAULT]);
    
        // Save input
        $chat->messages()->create([
            'role' => 'user',
            'content' => $content,
            'index' => 0,
            'finish_reason' => 'stop',
        ]);
    
        @ini_set('zlib.output_compression', 0);
        @ini_set('implicit_flush', 1);
        @ob_end_clean();
        set_time_limit(0);
    
        $aiContent = "";
        $letterCount = 0;
        $data = $this->makeChatRequest($content, $chat);
    
        foreach ($data as $item) {
            if ($item->choices[0]->delta->content != null) {
                // $aiContent .= $item->choices[0]->delta->content;

                $newContent = $item->choices[0]->delta->content;
                $aiContent .= $newContent;
                // Update letter count for new content only
                $letterCount += str_word_count($newContent);

            }
            if ($item->choices[0]->finishReason == 'stop') {
                $this->saveMessage($user, $chat, $aiContent, $item->choices[0]->finishReason);
            }
        }
        $user->update([
            'chat_word_count' => $letterCount,
        ]);
    
        // Return JSON response
        return response()->json([
            'response' => $aiContent,
            'original_question' => $content
        ]);
    }
    


    public function saveMessage($user, $chat, $aiContent, $finishReason)
    {
        $chat->messages()->create([
            'role' => 'assistant',
            'content' => $aiContent,
            'index' => 0,
            'finish_reason' => $finishReason,
        ]);
    }


    public function chatDeleteAll(Request $request)
    {
        $getChat = Chat::where('user_id',$request->userId)->first();
        $getChat->delete();
        return response()->json(['status' => 'Conversation Deleted Successfully.']);
    }


    public function chatDeleteSingle(Request $request, $id)
    {
        $getMessage = Message::where('id',$request->id)->first();
        $getMessage->delete();
        return redirect()->back();
    }

}
