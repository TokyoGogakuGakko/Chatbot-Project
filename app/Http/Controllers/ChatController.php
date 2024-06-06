<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use OpenAI;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function store(Request $request)
    {
        $userInput = $request->input('textInput'); // Get text input
        $audioUrl = null; // Initialize audio URL to null

        // 1. Handle Audio OR Text Input
        if ($request->hasFile('audioInput')) {
            $audioFile = $request->file('audioInput');
            $tempFilePath = $audioFile->storeAs('temp', $audioFile->getClientOriginalName(), 'public');

            $apiKey = env('OPENAI_API_KEY');
            $client = OpenAI::client($apiKey);

            $response = $client->audio()->transcribe([
                'model' => 'whisper-1',
                'file' => fopen(storage_path('app/public/' . $tempFilePath), 'r'),
                'response_format' => 'verbose_json',
            ]);

            $userInput = $response->text; // Use transcribed text as input
            $audioUrl = Storage::url($tempFilePath); // Store the audio URL
        }

        // 2. Generate AI Response
        $apiKey = env('OPENAI_API_KEY');
        $client = OpenAI::client($apiKey);

        $aiResponse = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $userInput],
            ],
        ]);
        $aiReply = $aiResponse->choices[0]->message->content;

        // 3. Convert AI Response to Speech
        $audioContent = $client->audio()->speech([
            'model' => 'tts-1',
            'input' => $aiReply,
            'voice' => 'alloy',
        ]);

        // 4. Store in Database
        $chat = new Chat;
        $chat->message = $userInput; // Store the user input
        $chat->response = $aiReply;
        $chat->save();

        // 5. Store Audio Temporarily
        $audioFileName = 'response_' . $chat->id . '.mp3';
        Storage::disk('public')->put('audio_responses/' . $audioFileName, $audioContent);

        // 6. Return JSON response with audio URL
        return response()->json([
            'ai_response' => $aiReply,
            'audio_url' => Storage::url('audio_responses/' . $audioFileName),
            'user_input' => $userInput,
            'user_audio_url' => $audioUrl, // Add user's audio URL
        ]);
    }
}
