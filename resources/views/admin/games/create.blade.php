{{-- ============================================================================
FILE: resources/views/admin/games/create.blade.php
DESCRIPTION: Form to create/insert a new game into the database
============================================================================ --}}

@extends('admin.layouts.app')

@section('title', 'Add New Game')
@section('page-title', 'Add New Game')

	    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

	<!--  -->
@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        {{-- Card Container --}}
        <div class="card shadow-sm">
            {{-- Card Header --}}
            <div class="card-header bg-gradient-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-plus-circle-fill"></i> Create New Game
                    </h5>
                    <a href="{{ route('games.index') }}" class="btn btn-sm btn-light">
                        <i class="bi bi-arrow-left"></i> Back to Games
                    </a>
                </div>
            </div>

            {{-- Card Body with Form --}}
            <div class="card-body p-4">
                {{-- Form starts here --}}
                <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data" id="createGameForm">
                    @csrf {{-- CSRF Token for security --}}

                    {{-- Section 1: Basic Information --}}
                    <div class="border-bottom pb-3 mb-4">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="bi bi-info-circle"></i> Basic Information
                        </h6>

                        <div class="row">
                            {{-- Game Icon Field --}}
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Icon <span class="text-danger">*</span>
                                    </label>

                                    <select name="icon"
                                        class="form-select form-select-lg text-center @error('icon') is-invalid @enderror"
                                        style="font-size: 2rem;">

                                        <option value="">Select</option>

                                        <option value="🧟" {{ old('icon') == '🧟' ? 'selected' : '' }}>🧟</option>
                                        <option value="🏈" {{ old('icon') == '🏈' ? 'selected' : '' }}>🏈</option>
                                        <option value="🍉" {{ old('icon') == '🍉' ? 'selected' : '' }}>🍉</option>
                                        <option value="⛏️" {{ old('icon') == '⛏️' ? 'selected' : '' }}>⛏️</option>
                                        <option value="🎯" {{ old('icon') == '🎯' ? 'selected' : '' }}>🎯</option>
                                        <option value="🏎️" {{ old('icon') == '🏎️' ? 'selected' : '' }}>🏎️</option>
                                        <option value="🗡️" {{ old('icon') == '🗡️' ? 'selected' : '' }}>🗡️</option>
                                        <option value="🧩" {{ old('icon') == '🧩' ? 'selected' : '' }}>🧩</option>
                                        <option value="⚔️" {{ old('icon') == '⚔️' ? 'selected' : '' }}>⚔️</option>
                                        <option value="🏀" {{ old('icon') == '🏀' ? 'selected' : '' }}>🏀</option>

                                        <!-- Default -->
                                        <option value="🎮" {{ old('icon', '🎮') == '🎮' ? 'selected' : '' }}>🎮</option>

                                    </select>

                                    @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            {{-- Game Title Field --}}
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Game Title
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title') }}"
                                        placeholder="Enter game title (e.g., Super Mario Bros)"
                                        required
                                        maxlength="255">

                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <small class="text-muted">Enter a unique and descriptive title</small>
                                </div>

                                {{-- Slug Preview (auto-generated) --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">URL Slug (Auto-generated)</label>
                                    <input
                                        type="text"
                                        class="form-control bg-light"
                                        id="slugPreview"
                                        readonly
                                        placeholder="super-mario-bros">
                                    <small class="text-muted">This will be auto-generated from the title</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Section 2: Game Details --}}
                    <div class="border-bottom pb-3 mb-4">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="bi bi-gear-fill"></i> Game Details
                        </h6>

                        <div class="row">
                            {{-- Category Selection --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Category
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select
                                        name="category"
                                        class="form-select @error('category') is-invalid @enderror"
                                        required>
                                        <option value="">-- Select Category --</option>
                                        <option value="Action" {{ old('category') == 'Action' ? 'selected' : '' }}>⚔️ Action</option>
                                        <option value="Adventure" {{ old('category') == 'Adventure' ? 'selected' : '' }}>🗺️ Adventure</option>
                                        <option value="Puzzle" {{ old('category') == 'Puzzle' ? 'selected' : '' }}>🧩 Puzzle</option>
                                        <option value="Sports" {{ old('category') == 'Sports' ? 'selected' : '' }}>⚽ Sports</option>
                                        <option value="Racing" {{ old('category') == 'Racing' ? 'selected' : '' }}>🏎️ Racing</option>
                                        <option value="Strategy" {{ old('category') == 'Strategy' ? 'selected' : '' }}>🎯 Strategy</option>
                                        <option value="Casual" {{ old('category') == 'Casual' ? 'selected' : '' }}>🎲 Casual</option>
                                        <option value="RPG" {{ old('category') == 'RPG' ? 'selected' : '' }}>🗡️ RPG</option>
                                        <option value="Shooting" {{ old('category') == 'Shooting' ? 'selected' : '' }}>🔫 Shooting</option>
                                        <option value="Fighting" {{ old('category') == 'Fighting' ? 'selected' : '' }}>🥊 Fighting</option>
                                        <option value="Simulation" {{ old('category') == 'Simulation' ? 'selected' : '' }}>✈️ Simulation</option>
                                        <option value="Multiplayer" {{ old('category') == 'Multiplayer' ? 'selected' : '' }}>👥 Multiplayer</option>
                                    </select>

                                    @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Status Selection --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Status
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select
                                        name="status"
                                        class="form-select @error('status') is-invalid @enderror"
                                        required>
                                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                                            ✅ Active (Visible to users)
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            ❌ Inactive (Hidden from users)
                                        </option>
                                    </select>

                                    @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Description Field --}}
                        <div class="mb-3" >
                            <label class="form-label fw-semibold">
                                Game Description
                            </label>
                            <textarea id="editor"
                                name="description"
                                class="form-control @error('description') is-invalid @enderror"
                                rows="4"
                                placeholder="Write a detailed description about the game..."
                                maxlength="1000">{{ old('description') }} </textarea>

                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="text-muted">
                                <span id="charCount">0</span>/1000 characters
                            </small>
                        </div>
                    </div>

                    {{-- Section 3: Statistics --}}
                    <div class="border-bottom pb-3 mb-4">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="bi bi-graph-up"></i> Game Statistics
                        </h6>

                        <div class="row">
                            {{-- Number of Plays --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Number of Plays
                                    </label>
                                    <input
                                        type="number"
                                        name="plays"
                                        class="form-control @error('plays') is-invalid @enderror"
                                        value="{{ old('plays', 0) }}"
                                        min="0"
                                        step="1"
                                        placeholder="0">

                                    @error('plays')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <small class="text-muted">Initial play count (default: 0)</small>
                                </div>
                            </div>

                            {{-- Game Rating --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Rating (1-5 stars)
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">⭐</span>
                                        <input
                                            type="number"
                                            name="rating"
                                            class="form-control @error('rating') is-invalid @enderror"
                                            value="{{ old('rating', 4.5) }}"
                                            step="0.1"
                                            min="1"
                                            max="5"
                                            placeholder="4.5">
                                    </div>

                                    @error('rating')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <small class="text-muted">Enter a rating between 1.0 and 5.0</small>
                                </div>
                            </div>

                            {{-- Thumbnail Upload --}}
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Game Thumbnail
                                    </label>
                                    <input
                                        type="file"
                                        name="thumbnail"
                                        class="form-control @error('thumbnail') is-invalid @enderror"
                                        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                        id="thumbnailInput">

                                    @error('thumbnail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <small class="text-muted">Max size: 2MB (JPG, PNG, GIF, WEBP)</small>
                                </div>

                                {{-- Image Preview --}}
                                <div id="imagePreview" class="mt-2" style="display: none;">
                                    <img src="" alt="Preview" class="img-thumbnail" style="max-height: 150px;">
                                    <button type="button" class="btn btn-sm btn-danger mt-2" id="removeImage">
                                        <i class="bi bi-trash"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Section 4: Additional Information --}}
                    <div class="mb-4">
                        <h6 class="text-primary fw-bold mb-3">
                            <i class="bi bi-link-45deg"></i> Additional Information
                        </h6>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Game URL (Optional)
                            </label>
                            <div class="input-group" >
                                <span class="input-group-text">🌐</span>
                                <input
                                    type="url"
                                    name="url"
                                    class="form-control @error('url') is-invalid @enderror"
                                    value="{{ old('url') }}"
                                    placeholder="https://example.com/game-link"
                                    maxlength="500">
                            </div>

                            @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <small class="text-muted">Enter the URL where users can play this game</small>
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="border-top pt-4">
                        <div class="d-flex gap-2 justify-content-between">
                            {{-- Cancel Button --}}
                            <a href="{{ route('games.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>

                            <div class="d-flex gap-2">
                                {{-- Reset Button --}}
                                <button type="reset" class="btn btn-outline-warning">
                                    <i class="bi bi-arrow-clockwise"></i> Reset Form
                                </button>

                                {{-- Submit Button --}}
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="bi bi-check-circle"></i> Create Game
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Help Card --}}
        <div class="card mt-4 bg-light">
            <div class="card-body">
                <h6 class="fw-bold mb-2">
                    <i class="bi bi-lightbulb text-warning"></i> Tips for Creating Games
                </h6>
                <ul class="mb-0 small">
                    <li>Use descriptive and unique titles for better SEO</li>
                    <li>Choose an appropriate emoji icon that represents the game</li>
                    <li>Write detailed descriptions to help users understand the game</li>
                    <li>Upload high-quality thumbnails (recommended: 16:9 ratio)</li>
                    <li>Set status to "Inactive" if the game is not ready yet</li>
                    <li>Fields marked with <span class="text-danger">*</span> are required</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .form-label {
        font-size: 14px;
        margin-bottom: 6px;
    }

    .card {
        border: none;
        border-radius: 12px;
    }

    .card-header {
        border-radius: 12px 12px 0 0 !important;
    }

    #imagePreview img,
    .img-thumbnail {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        background: #fff;
        max-width: 100%;
        height: auto;
    }

    #imagePreview {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }

    #removeImage {
        padding: 0.25rem 0.75rem;
        font-size: 0.9rem;
        border-radius: 6px;
        transition: background 0.2s;
    }

    #removeImage:hover {
        background: #dc3545;
        color: #fff;
    }

    .input-group-text {
        background-color: #f8f9fa;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.95em;
        margin-top: 0.25rem;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.1rem rgba(220, 53, 69, .15);
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {

        // ========================================
        // Auto-generate slug from title
        // ========================================
        $('input[name="title"]').on('keyup', function() {
            let title = $(this).val();
            let slug = title.toLowerCase()
                .replace(/[^\w\s-]/g, '') // Remove special characters
                .replace(/\s+/g, '-') // Replace spaces with hyphens
                .replace(/-+/g, '-') // Replace multiple hyphens with single
                .trim();

            $('#slugPreview').val(slug);
        });

        // ========================================
        // Character counter for description
        // ========================================
        $('textarea[name="description"]').on('keyup', function() {
            let count = $(this).val().length;
            $('#charCount').text(count);

            if (count > 900) {
                $('#charCount').addClass('text-danger');
            } else {
                $('#charCount').removeClass('text-danger');
            }
        });

        // ========================================
        // Image preview functionality
        // ========================================
        $('#thumbnailInput').on('change', function(e) {
            let file = e.target.files[0];

            if (file) {
                // Check file size (2MB max)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB!');
                    $(this).val('');
                    return;
                }

                // Show preview
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview img').attr('src', e.target.result);
                    $('#imagePreview').show();
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove image preview
        $('#removeImage').on('click', function() {
            $('#thumbnailInput').val('');
            $('#imagePreview').hide();
        });

        // ========================================
        // Form validation before submit
        // ========================================
        $('#createGameForm').on('submit', function(e) {
            let title = $('input[name="title"]').val().trim();
            let category = $('select[name="category"]').val();
            let icon = $('input[name="icon"]').val().trim();

            // Check if required fields are filled
            if (!title || !category || !icon) {
                e.preventDefault();
                alert('Please fill in all required fields marked with *');
                return false;
            }

            // Confirm submission
            if (!confirm('Are you sure you want to create this game?')) {
                e.preventDefault();
                return false;
            }

            // Show loading state
            $(this).find('button[type="submit"]')
                .html('<i class="bi bi-hourglass-split"></i> Creating...')
                .prop('disabled', true);
        });

        // ========================================
        // Initialize tooltips
        // ========================================
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // ========================================
        // Reset form functionality
        // ========================================
        $('button[type="reset"]').on('click', function() {
            if (confirm('Are you sure you want to reset all fields?')) {
                $('#imagePreview').hide();
                $('#slugPreview').val('');
                $('#charCount').text('0');
            } else {
                return false;
            }
        });
    });
</script>

<script>
    // Activate CKEditor on the textarea
    CKEDITOR.replace('editor');
</script>

@endpush