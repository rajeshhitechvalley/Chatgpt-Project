@extends('admin.layouts.app')

@section('title', 'Games Management')
@section('page-title', 'Games Management')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2>All Games</h2>
            <a href="{{ route('games.create') }}" class="btn btn-gradient">
                <i class="bi bi-plus-circle"></i> Add New Game
            </a>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('games.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search games..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search"></i> Search
                </button>
                <a href="{{ route('games.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Games Table -->
<div class="card">
    <div class="card-header bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Games List ({{ $games->total() }})</h5>
            <button class="btn btn-sm btn-danger" id="bulkDeleteBtn" style="display: none;">
                <i class="bi bi-trash"></i> Delete Selected
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">
                            <input type="checkbox" id="selectAll">
                        </th>
                        <th>Game</th>
                        <th>Category</th>
                        <th>Plays</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($games as $game)
                    <tr>
                        <td>
                            <input type="checkbox" class="game-checkbox" value="{{ $game->id }}">
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="game-thumb">{{ $game->icon }}</div>
                                <div>
                                    <div class="fw-semibold">{!!  $game->title !!}</div>
                                    <small class="text-muted">{!!  Str::limit($game->description, 50) !!}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $game->category }}</td>
                        <td>{{ $game->formatted_plays }}</td>
                        <td>
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-star-fill"></i> {{ $game->rating }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $game->status == 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($game->status) }}
                            </span>
                        </td>
                        <td>{{ $game->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('games.edit', $game) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-info toggle-status" data-id="{{ $game->id }}">
                                    <i class="bi bi-toggle-on"></i>
                                </button>
                                <form action="{{ route('games.destroy', $game) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #cbd5e0;"></i>
                            <p class="text-muted mt-2">No games found</p>
                            <a href="{{ route('games.create') }}" class="btn btn-gradient">Add First Game</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $games->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Select All Checkboxes
    $('#selectAll').change(function() {
        $('.game-checkbox').prop('checked', this.checked);
        toggleBulkDelete();
    });

    $('.game-checkbox').change(function() {
        toggleBulkDelete();
    });

    function toggleBulkDelete() {
        const checked = $('.game-checkbox:checked').length;
        if (checked > 0) {
            $('#bulkDeleteBtn').show();
        } else {
            $('#bulkDeleteBtn').hide();
        }
    }

    // Bulk Delete
    $('#bulkDeleteBtn').click(function() {
        if (!confirm('Are you sure you want to delete selected games?')) return;

        const ids = $('.game-checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        $.post('{{ route("games.bulk-delete") }}', { ids: ids })
            .done(function(response) {
                location.reload();
            });
    });

    // Toggle Status
    $('.toggle-status').click(function() {
        const gameId = $(this).data('id');
        $.post(`/admin/games/${gameId}/toggle-status`)
            .done(function(response) {
                location.reload();
            });
    });

    // Delete Confirmation
    $('.delete-form').submit(function(e) {
        if (!confirm('Are you sure you want to delete this game?')) {
            e.preventDefault();
        }
    });
});
</script>
@endpush