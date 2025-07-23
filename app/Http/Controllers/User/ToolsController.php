<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Category;
use App\Models\Answer;
use App\Models\Content;
use App\Models\Prompt;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
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


class ToolsController extends Controller
{

    use ToolsTrait;

    public function toolsIndex($id)
    {
        $getCategoryDetails = Category::where('id',$id)->first();
        $getAllPrompts = Prompt::with('category')->where('category_id',$id)->get();
        return view('users.tools.index', compact('getCategoryDetails','getAllPrompts'));
    }


    public function toolsPromptsIndex($id)
    {
        $getUser = Auth::guard('user')->user();
        $getWallet = Wallet::where('user_id',$getUser->id)->first();
        $getPromptDetails = Prompt::with(['category','questions'])->where('id',$id)->first();
        $questions = $getPromptDetails->questions;
        // dd($questions);
        return view('users.tools.detail', compact('getPromptDetails','getWallet','questions'));
    }



    // Working with complete code 
    //     public function toolsPromptsStore(Request $request)
    // {
    //     $prompt = Prompt::where('id', $request->prompt_id)->firstOrFail();
    //     $user = Auth::guard('user')->user();

    //     @ini_set('zlib.output_compression', 0);
    //     @ini_set('implicit_flush', 1);
    //     @ob_end_clean();
    //     set_time_limit(0);

    //     $aiContent = "";
    //     $data = $this->generate($request);

    //     $response = new StreamedResponse(function () use ($data, &$aiContent, $request, $user, $prompt) {
    //         foreach ($data as $item) {
    //             $content = $item->choices[0]?->text ?? ($item->choices[0]?->delta->content ?? '');
    //             $aiContent .= $content;

    //             if ($item->choices[0]->finishReason == 'stop') {
    //                 $this->saveContent($user, $request, $aiContent, $prompt);
    //             }
    //         }

    //         echo json_encode(['content' => $aiContent]);
    //         flush();
    //     });

    //     $response->headers->set('Content-Type', 'text/event-stream');
    //     $response->headers->set('Cache-Control', 'no-cache');
    //     $response->headers->set('X-Accel-Buffering', 'no');

    //     return $response->send();
    // }

    public function toolsPromptsStore(Request $request)
    {
        $prompt = Prompt::where('id', $request->prompt_id)->firstOrFail();
        $user = Auth::guard('user')->user();

        @ini_set('zlib.output_compression', 0);
        @ini_set('implicit_flush', 1);
        @ob_end_clean();
        set_time_limit(0);

        $aiContent = "";
        $data = $this->generate($request);

        $response = new StreamedResponse(function () use ($data, &$aiContent, $request, $user, $prompt) {
            $wordCount = 0;
            foreach ($data as $item) {
                $content = $item->choices[0]?->text ?? ($item->choices[0]?->delta->content ?? '');
                $aiContent .= $content;

                // Update word count
                $wordCount += str_word_count($content);
                // Update word count for the new content only
                // $newWords = str_word_count($content);
                // $wordCount += $newWords;

                if ($item->choices[0]->finishReason == 'stop') {
                    $this->saveContent($user, $request, $aiContent, $prompt);
                }
            }

            // // CHECK FOR SONG HERE
            // $mp3_url = null;
            // // Check if content contains "verse" (case-insensitive)
            // if (stripos($aiContent, 'verse') !== false) {
            //     // Prepare paths
            //     $publicPath = public_path('user-songs');
            //     if (!file_exists($publicPath)) {
            //         mkdir($publicPath, 0777, true);
            //     }

            //     // Unique filename based on timestamp + user id
            //     $fileBaseName = 'song_' . $user->id . '_' . time();
            //     $wavPath = $publicPath . '/' . $fileBaseName . '.wav';
            //     $mp3Path = $publicPath . '/' . $fileBaseName . '.mp3';

            //     // Escape text to shell-safe
            //     $escapedText = escapeshellarg($aiContent);

            //     // Run pico2wave command to create WAV
            //     shell_exec("pico2wave -w={$wavPath} {$escapedText}");

            //     // Convert WAV to MP3 using ffmpeg
            //     shell_exec("ffmpeg -y -i {$wavPath} {$mp3Path}");

            //     // Delete the WAV file after conversion
            //     if (file_exists($wavPath)) {
            //         unlink($wavPath);
            //     }

            //     // Set public URL accessible by frontend
            //     $mp3_url = url('user-songs/' . basename($mp3Path));
            // }
            

            // CHECK FOR SONG HERE
            $mp3_url = null;
            // Check if content contains "verse" (case-insensitive)
            if (stripos($aiContent, 'verse') !== false) {
                // Prepare paths
                $publicPath = public_path('user-songs');
                if (!file_exists($publicPath)) {
                    mkdir($publicPath, 0777, true);
                }

                // Unique filename
                $fileBaseName = 'speech_' . $user->id . '_' . time();
                $mp3Path = $publicPath . '/' . $fileBaseName . '.mp3';

                // Escape text and remove line breaks for cleaner speech
                $cleanText = preg_replace('/\s+/', ' ', $aiContent); // Remove extra whitespace
                $escapedText = escapeshellarg($cleanText);

                // Use espeak with better parameters for clear speech
                shell_exec("espeak -v en-us -s 150 -p 50 -a 200 -g 5 -z {$escapedText} --stdout | ffmpeg -y -i - -ar 44100 -ac 2 -ab 192k -f mp3 {$mp3Path}");

                // Set public URL
                $mp3_url = url('user-songs/' . basename($mp3Path));
            }

            echo json_encode(['content' => $aiContent,'mp3_url' => $mp3_url]);

            // echo json_encode(['content' => $aiContent]);
            flush();
            $user->update([
                'text_word_count' => $wordCount,
            ]);
        });


        

        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('Cache-Control', 'no-cache');
        $response->headers->set('X-Accel-Buffering', 'no');

        return $response->send();
    }


    public function toolsPromptsStoreImage(Request $request)
    {
        $prompt = Prompt::where('id', $request->get('prompt_id'))->firstOrFail();
        $user = Auth::guard('user')->user();

        $wordCount = 0;
        $aiContent = $this->generate($request);
        // dd($aiContent);
        $content = $this->saveContent($user, $request, $aiContent, $prompt);

        // Calculate word count
        $wordCount = str_word_count($content->content);
        $user->update([
            'image_word_count' => $wordCount,
        ]);

        // return ($content->content);

        return response()->json([
            'success' => true,
            'message' => $content->content
        ]);
    }



    public function saveContent($user, $request, $aiContent, $prompt)
    {
        $content = Content::create([
            'user_id' => $user->id,
            'prompt_id' => $request->get('prompt_id'),
            'engine_id' => $prompt->engine->id ?? null,
            'outputs_count' => $request->get('outputs_count') ?? 1,
            'content' => $aiContent,
        ]);

        // Save answers
        foreach ($prompt->questions as $question) {
            Answer::create([
                'answer' => $request->get('question_' . $question->id) ?? "",
                'question_id' => $question->id,
                'content_id' => $content->id
            ]);
        }
        return $content;
    }


}
