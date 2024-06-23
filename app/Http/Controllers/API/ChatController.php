<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatRequest;
use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Chat;
use OpenAI;

class ChatController extends Controller
{
    private $client;
    private $maxQuestions = 5;

    public function __construct()
    {
        $this->client = OpenAI::client(config('app.openai_api_key'));
    }

    public function index(Request $request)
    {
        $chats = [];
        $selectedConversationId = $request->get('conversationId');

        $conversations = Conversation::all();

        if ($selectedConversationId) {
            $chats = $conversations->find($selectedConversationId)->chats()->get();
        }

        return view('chat', compact('selectedConversationId', 'conversations', 'chats'));
    }

    public function startInterview(Request $request)
    {
        $conversationId = $request->input('conversation_id');
        $conversation = Conversation::findOrFail($conversationId);
        $context = $conversation->context;

        $prompt = $this->generateInitialPrompt($context);
        $response = $this->getGPTResponse($prompt);

        $botChat = Chat::create([
            'conversation_id' => $conversationId,
            'message' => $response,
            'user_type' => 'bot',
        ]);

        return response()->json([
            'chats' => $conversation->chats()->get(),
        ]);
    }

    public function store(ChatRequest $request)
    {
        $message = $request->validated('message');
        $conversationId = $request->validated('conversation_id');

        $conversation = Conversation::findOrFail($conversationId);
        $context = $conversation->context;

        $chat = Chat::create([
            'conversation_id' => $conversationId,
            'message' => $message,
            'user_type' => 'user',
        ]);

        $prompt = $this->generatePrompt($context, $chat);
        $response = $this->getGPTResponse($prompt);

        $botChat = Chat::create([
            'conversation_id' => $conversationId,
            'message' => $response,
            'user_type' => 'bot',
        ]);

        return response()->json([
            'chats' => $conversation->chats()->get(),
        ]);
    }

    private function generateInitialPrompt($context)
    {
        $prompt = "You are an AI interviewer. Your task is to conduct an interview based on the following context:\n\n";
        $prompt .= $context . "\n\n";
        $prompt .= "Start the interview by asking the first question. Your response should be just the question, without any additional text.";

        return $prompt;
    }

    private function generatePrompt($context, $chat)
    {
        $previousChats = Chat::where('conversation_id', $chat->conversation_id)
            ->where('id', '<', $chat->id)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get()
            ->reverse();

        $prompt = "You are an AI interviewer. Your task is to conduct an interview based on the following context:\n\n";
        $prompt .= $context . "\n\n";
        $prompt .= "Previous messages:\n";

        foreach ($previousChats as $previousChat) {
            $prompt .= "{$previousChat->role}: {$previousChat->message}\n";
        }

        $prompt .= "user: {$chat->message}\n\n";
        $prompt .= "Based on this context and the user's last message, ask a single, relevant question to continue the interview. Ignore any off-topic messages. Your response should be just the question, without any additional text.";

        return $prompt;
    }

    private function getGPTResponse($prompt)
    {
        $response = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => $prompt],
            ],
            'max_tokens' => 100,
            'temperature' => 0.7,
        ]);

        return trim($response->choices[0]->message->content);
    }
}
