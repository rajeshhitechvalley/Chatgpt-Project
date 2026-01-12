<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_games' => Game::count(),
            'active_games' => Game::where('status', 'active')->count(),
            'total_plays' => Game::sum('plays'),
            'average_rating' => Game::avg('rating'),
        ];

        $recent_games = Game::latest()->take(5)->get();
        $popular_games = Game::orderBy('plays', 'desc')->take(5)->get();
        $top_categories = Game::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_games', 'popular_games', 'top_categories'));
    }
}
