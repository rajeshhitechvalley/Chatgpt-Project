<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GameController extends Controller
{
    /**
     * Display a listing of games
     */
    public function index(Request $request)
    {
        $query = Game::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $games = $query->paginate(15);
        $categories = Game::distinct()->pluck('category');

        return view('admin.games.index', compact('games', 'categories'));
    }

    /**
     * Show the form for creating a new game
     */
    public function create()
    {
        $categories = $this->getCategories();
        return view('admin.games.create', compact('categories'));
    }

    /**
     * Store a newly created game
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:10',
            'title' => 'required|string|max:255|unique:games,title',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'plays' => 'nullable|integer|min:0',
            'rating' => 'nullable|numeric|min:1|max:5',
            'status' => 'required|in:active,inactive',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url'
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('games', 'public');
        }

        // Auto-generate slug
        $validated['slug'] = Str::slug($validated['title']);

        Game::create($validated);

        return redirect()->route('games.index')
            ->with('success', 'Game created successfully!');
    }

    /**
     * Display the specified game
     */
    public function show(Game $game)
    {
        return view('admin.games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified game
     */
    public function edit(Game $game)
    {
        $categories = $this->getCategories();
        return view('admin.games.edit', compact('game', 'categories'));
    }

    /**
     * Update the specified game
     */
    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'icon' => 'required|string|max:10',
            'title' => 'required|string|max:255|unique:games,title,' . $game->id,
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'plays' => 'nullable|integer|min:0',
            'rating' => 'nullable|numeric|min:1|max:5',
            'status' => 'required|in:active,inactive',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url'
        ]);

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($game->thumbnail) {
                Storage::disk('public')->delete($game->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('games', 'public');
        }

        $game->update($validated);

        return redirect()->route('admin.games.index')
            ->with('success', 'Game updated successfully!');
    }

    /**
     * Remove the specified game
     */
    public function destroy(Game $game)
    {
        // Delete thumbnail if exists
        if ($game->thumbnail) {
            Storage::disk('public')->delete($game->thumbnail);
        }

        $game->delete();

        return redirect()->route('games.index')
            ->with('success', 'Game deleted successfully!');
    }

    /**
     * Bulk delete games
     */
    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:games,id'
        ]);

        $games = Game::whereIn('id', $validated['ids'])->get();
        
        foreach ($games as $game) {
            if ($game->thumbnail) {
                Storage::disk('public')->delete($game->thumbnail);
            }
            $game->delete();
        }

        return response()->json([
            'success' => true,
            'message' => count($validated['ids']) . ' games deleted successfully!'
        ]);
    }

    /**
     * Toggle game status
     */
    public function toggleStatus(Game $game)
    {
        $game->status = $game->status === 'active' ? 'inactive' : 'active';
        $game->save();

        return response()->json([
            'success' => true,
            'status' => $game->status
        ]);
    }

    /**
     * Get categories list
     */
    private function getCategories()
    {
        return [
            'Action',
            'Adventure',
            'Puzzle',
            'Sports',
            'Racing',
            'Strategy',
            'Casual',
            'RPG',
            'Shooting',
            'Fighting',
            'Simulation',
            'Multiplayer'
        ];
    }
    public function category($category)
{
    $games = Game::active()
        ->where('category', $category)
        ->get();

    return view('partials.nav', compact('games', 'category'));
}

}
