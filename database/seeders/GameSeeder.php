<?php
namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run()
    {
        $games = [
            [
                'icon' => '🧟',
                'title' => 'Jackal Zombie Survival',
                'category' => 'Action',
                'description' => 'Survive the zombie apocalypse in this intense action game',
                'plays' => 12500,
                'rating' => 4.8,
                'status' => 'active',
            ],
            [
                'icon' => '🏈',
                'title' => 'Big Hit Football',
                'category' => 'Sports',
                'description' => 'Experience American football action like never before',
                'plays' => 8200,
                'rating' => 4.5,
                'status' => 'active',
            ],
            [
                'icon' => '🍉',
                'title' => 'Merge a Fruit',
                'category' => 'Puzzle',
                'description' => 'Merge fruits to create new ones in this addictive puzzle game',
                'plays' => 15800,
                'rating' => 4.7,
                'status' => 'active',
            ],
            [
                'icon' => '⛏️',
                'title' => 'Dig out of Prison',
                'category' => 'Adventure',
                'description' => 'Plan your escape from prison by digging tunnels',
                'plays' => 9300,
                'rating' => 4.6,
                'status' => 'active',
            ],
            [
                'icon' => '🎯',
                'title' => 'Target Master',
                'category' => 'Casual',
                'description' => 'Hit all targets with precision and speed',
                'plays' => 5600,
                'rating' => 4.3,
                'status' => 'active',
            ],
            [
                'icon' => '🏎️',
                'title' => 'Speed Racer Pro',
                'category' => 'Racing',
                'description' => 'Race against time in this high-speed racing game',
                'plays' => 11200,
                'rating' => 4.9,
                'status' => 'active',
            ],
            [
                'icon' => '🗡️',
                'title' => 'Knight Quest',
                'category' => 'RPG',
                'description' => 'Embark on an epic quest to save the kingdom',
                'plays' => 7800,
                'rating' => 4.4,
                'status' => 'active',
            ],
            [
                'icon' => '🧩',
                'title' => 'Brain Teaser 3000',
                'category' => 'Puzzle',
                'description' => 'Challenge your mind with complex puzzles',
                'plays' => 6500,
                'rating' => 4.2,
                'status' => 'inactive',
            ],
            [
                'icon' => '⚔️',
                'title' => 'Battle Royale Arena',
                'category' => 'Multiplayer',
                'description' => 'Fight to be the last player standing',
                'plays' => 18900,
                'rating' => 4.8,
                'status' => 'active',
            ],
            [
                'icon' => '🏀',
                'title' => 'Hoop Dreams',
                'category' => 'Sports',
                'description' => 'Score baskets and become a basketball legend',
                'plays' => 4200,
                'rating' => 4.1,
                'status' => 'active',
            ],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}