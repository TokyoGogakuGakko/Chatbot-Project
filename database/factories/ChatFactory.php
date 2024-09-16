<?php

namespace Database\Factories;

use App\Models\Conversation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    public function definition(): array
    {
        return [
            'conversation_id' => Conversation::factory(),
            'message' => $this->faker->paragraph(),
            'user_type' => $this->faker->randomElement(['user', 'bot']),
        ];
    }
}
