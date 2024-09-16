<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Conversation;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    public function run(): void
    {
        Conversation::all()->each(function ($conversation) {
            Chat::factory(rand(5, 15))->create([
                'conversation_id' => $conversation->id,
            ]);
        });
    }
}
