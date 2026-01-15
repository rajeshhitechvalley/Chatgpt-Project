<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Display the homepage with featured games
     * Route: GET /
     */
    public function index()
    {
        // Get featured games (top rated and active)
        $featuredGames = Game::active()
            ->where('category', 'Featured')
            ->orderBy('rating', 'desc')
            ->take(7)
            ->get();

        // Get new games (recently added)
        $newGames = Game::active()
            ->where('category', 'New')
            ->latest()
            ->take(10)
            ->get();
        $allGames = Game::active()
            ->latest()
            ->take(10)
            ->get();

        // Get popular games (most played)
        $popularGames = Game::active()
            ->orderBy('plays', 'desc')
            ->take(10)
            ->get();

        // Get all unique categories
        $categories = Game::active()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $comet = Game::active()
            ->where('category', 'Comet')
            ->get();


        // Get game statistics
        $stats = [
            'total_games' => Game::active()->count(),
            'total_plays' => Game::active()->sum('plays'),
            'categories_count' => $categories->count(),
        ];

        return view('welcome', compact(
            'featuredGames',
            'newGames',
            'popularGames',
            'categories',
            'stats',
            'comet',
            'allGames'
        ));
    }

    /**
     * Display all games with filters
     * Route: GET /games
     */
    public function allGames(Request $request)
    {
        $query = Game::active();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'popular':
                $query->orderBy('plays', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->latest();
        }

        // Paginate results
        $games = $query->paginate(24);

        // Get all categories for filter
        $categories = Game::active()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('frontend.games', compact('games', 'categories'));
    }


    public function show($slug)
    {
        // Find game by slug
        $game = Game::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        // Increment play count
        $game->increment('plays');

        // Get related games (same category)
        $relatedGames = Game::active()
            ->where('category', $game->category)
            ->where('id', '!=', $game->id)
            ->take(6)
            ->get();

        // Get recent games
        $recentGames = Game::active()
            ->latest()
            ->take(5)
            ->get();

        return view('single', compact('game', 'relatedGames', 'recentGames'));
    }

    /**
     * Display games by category
     * Route: GET /category/{category}
     */
    public function category($category)
    {
        // Get games in this category
        $games = Game::active()
            ->where('category', $category)
            ->orderBy('plays', 'desc')
            ->paginate(24);

        // Get category stats
        $categoryStats = [
            'total_games' => $games->total(),
            'total_plays' => Game::where('category', $category)->sum('plays'),
            'avg_rating' => Game::where('category', $category)->avg('rating'),
        ];

        // Get all categories for navigation
        $categories = Game::active()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('frontend.category', compact('games', 'category', 'categoryStats', 'categories'));
    }

    /**
     * Search games (AJAX endpoint)
     * Route: GET /search
     */
    public function search(Request $request)
    {
        $search = $request->get('q', '');

        if (strlen($search) < 2) {
            return response()->json([]);
        }

        $games = Game::active()
            ->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->take(10)
            ->get(['id', 'title', 'slug', 'icon', 'category']);

        return response()->json($games);
    }

    /**
     * Get popular games (AJAX endpoint)
     * Route: GET /popular-games
     */
    public function popularGames()
    {
        $games = Cache::remember('popular_games', 3600, function () {
            return Game::active()
                ->orderBy('plays', 'desc')
                ->take(10)
                ->get();
        });

        return response()->json($games);
    }

    /**
     * Get new games (AJAX endpoint)
     * Route: GET /new-games
     */
    public function newGames()
    {
        $games = Cache::remember('new_games', 1800, function () {
            return Game::active()
                ->latest()
                ->take(10)
                ->get();
        });

        return response()->json($games);
    }

    /**
     * Play game (increment play count)
     * Route: POST /game/{slug}/play
     */
    public function play($slug)
    {
        $game = Game::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $game->increment('plays');

        return response()->json([
            'success' => true,
            'plays' => $game->formatted_plays
        ]);
    }

    /**
     * Get trending games
     * Route: GET /trending
     */
    public function trending()
    {
        // Games with high plays in last 7 days (simplified version)
        $trendingGames = Game::active()
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('plays', 'desc')
            ->take(12)
            ->get();

        // If not enough new games, get overall popular games
        if ($trendingGames->count() < 12) {
            $trendingGames = Game::active()
                ->orderBy('plays', 'desc')
                ->take(12)
                ->get();
        }

        $categories = Game::active()
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('frontend.trending', compact('trendingGames', 'categories'));
    }

    /**
     * Get recently played games (from session)
     * Route: GET /recently-played
     */
    public function recentlyPlayed(Request $request)
    {
        $recentlyPlayedIds = $request->session()->get('recently_played', []);

        if (empty($recentlyPlayedIds)) {
            return view('frontend.recently-played', ['games' => collect([])]);
        }

        // Get games maintaining the order
        $games = Game::active()
            ->whereIn('id', $recentlyPlayedIds)
            ->get()
            ->sortBy(function ($game) use ($recentlyPlayedIds) {
                return array_search($game->id, $recentlyPlayedIds);
            });

        return view('frontend.recently-played', compact('games'));
    }

    /**
     * Add game to recently played (AJAX)
     * Route: POST /add-to-recently-played
     */
    public function addToRecentlyPlayed(Request $request, $gameId)
    {
        $recentlyPlayed = $request->session()->get('recently_played', []);

        // Remove if already exists
        $recentlyPlayed = array_diff($recentlyPlayed, [$gameId]);

        // Add to beginning
        array_unshift($recentlyPlayed, $gameId);

        // Keep only last 20 games
        $recentlyPlayed = array_slice($recentlyPlayed, 0, 20);

        $request->session()->put('recently_played', $recentlyPlayed);

        return response()->json(['success' => true]);
    }
}
