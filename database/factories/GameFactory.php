<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition()
    {
        $emojis = ['🎮', '🕹️', '🎯', '🏆', '⚽', '🏀', '🎲', '🃏', '🎰', '🎪'];
        $categories = ['Action', 'Adventure', 'Puzzle', 'Sports', 'Racing', 'Strategy', 'Casual', 'RPG'];
        $statuses = ['active', 'inactive'];

        return [
            'icon' => $this->faker->randomElement($emojis),
            'title' => $this->faker->unique()->words(3, true) . ' Game',
            'category' => $this->faker->randomElement($categories),
            'description' => $this->faker->sentence(15),
            'plays' => $this->faker->numberBetween(100, 50000),
            'rating' => $this->faker->randomFloat(1, 3.0, 5.0),
            'status' => $this->faker->randomElement($statuses),
            'url' => $this->faker->url(),
        ];
    }
}