<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $game->description ?? 'Test game is not configured yet' }}">
    <meta name="keywords" content="{{ $game->category ?? 'Test game is not configured yet'}}, {{ $game->title ?? 'Test game is not configured yet'}}, online game, free game">

    <title>{{ $game->title ?? 'Test game is not configured yet' }} - Play Free Online | CrazyGames</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('single.css') }}">
</head>
<body>
    {{-- Navigation Bar --}}
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                🎮 CrazyGames
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">All Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">{{ $game->category ?? 'Test game is not configured yet' }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row">
            {{-- Main Game Section --}}
            <div class="col-lg-9">
                {{-- Game Container --}}
                <div class="game-container">
                    {{-- Game Header --}}
                    <div class="game-header">
                        <div class="d-flex align-items-center gap-3">
                            <div class="game-icon">{{ $game->icon ?? 'Test game is not configured yet' }}</div>
                            <div>
                                <h1 class="game-title">{{ $game->title ?? 'Test game is not configured yet' }}</h1>
                                <div class="game-meta">
                                    <div class="meta-item">
                                        <i class="bi bi-folder"></i>
                                        <span>{{ $game->category ?? 'Test game is not configured yet' }}</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="bi bi-star-fill"></i>
                                        <span>{{ $game->rating ?? 'Test game is not configured yet' }} Rating</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="bi bi-play-fill"></i>
                                        <span id="playCount">{{ $game->formatted_plays ?? 'Test game is not configured yet' }}</span> Plays
                                    </div>
                                    <div class="meta-item">
                                        <i class="bi bi-calendar"></i>
                                        <span>{{ $game->created_at->format('M d, Y') ?? 'Test game is not configured yet' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Game Controls --}}
                    <div class="game-controls">
                        <div class="d-flex gap-2">
                           
                            <button class="btn-fullscreen" onclick="toggleFullscreen()">
                                <i class="bi bi-arrows-fullscreen"></i>
                            </button>
                            <button class="btn-favorite" onclick="toggleFavorite()">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                        <div class="text-muted">
                            <small><i class="bi bi-info-circle"></i> Press F11 for fullscreen</small>
                        </div>
                    </div>

                    {{-- Game Frame --}}
                    <div id="gameContainer">
                        <div class="loading-spinner">
                            <div>
                                 <button class="btn-play" id="playBtn" onclick="loadGame()">
                                <i class="bi bi-play-fill"></i> Play Now
                            </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Game Information --}}
                <div class="game-info">
                    {{-- Description --}}
                    <div class="mb-4 bg-light p-3 rounded">
                        <h2 class="section-title">About {!! $game->title ?? 'Test game is not configured yet' !!}</h2>
                        <p class="game-description">
                            {!! $game->description ?? 'Experience exciting gameplay in this amazing game. Challenge yourself and have fun!' !!}
                        </p>
                    </div>

                    {{-- Game Details --}}
                    <div class="mb-4 bg-light p-3 rounded">
                        <h2 class="section-title">Game Details</h2>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <strong><i class="bi bi-folder2"></i> Category:</strong>
                                <a href="" class="game-tag">
                                    {{ $game->category ?? 'Test game is not configured yet' }}
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="bi bi-star-fill"></i> Rating:</strong>
                                <span class="rating-stars">
                                   
                                            <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                    <span class="text-muted">({{ $game->rating ?? 'Test game is not configured yet' }})</span>
                                </span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="bi bi-play-circle"></i> Total Plays:</strong>
                                <span class="text-primary fw-bold">{{ $game->formatted_plays ?? 'Test game is not configured yet' }}</span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong><i class="bi bi-calendar-check"></i> Added:</strong>
                                <span>2026-10-20</span>
                            </div>
                        </div>
                    </div>

                    {{-- Share Section --}}
                    <div class="mb-4 bg-light p-3 rounded">
                        <h2 class="section-title">Share This Game</h2>
                        <div class="share-buttons">
                            <button class="share-btn facebook" onclick="shareOnFacebook()">
                                <i class="bi bi-facebook"></i> Facebook
                            </button>
                            <button class="share-btn twitter" onclick="shareOnTwitter()">
                                <i class="bi bi-twitter"></i> Twitter
                            </button>
                            <button class="share-btn whatsapp" onclick="shareOnWhatsApp()">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </button>
                            <button class="share-btn copy" onclick="copyLink()">
                                <i class="bi bi-link-45deg"></i> Copy Link
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-3">
                {{-- Related Games --}}
                <div class="mb-4">
                    <h3 class="section-title">Related Games</h3>
                    <div class="d-flex flex-column gap-3">
                        <a href="" class="related-game-card">
                            <div class="related-game-thumb">11</div>
                            <div class="related-game-info">
                                <div class="related-game-title">Title</div>
                                <div class="related-game-category">
                                    Action 100
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                {{-- Recent Games --}}
                <div class="mb-4">
                    <h3 class="section-title">Recent Games</h3>
                    <div class="d-flex flex-column gap-3">
                        
                        <a href="" class="related-game-card">
                            <div class="related-game-thumb">😍</div>
                            <div class="related-game-info">
                                <div class="related-game-title">Title</div>
                                <div class="related-game-category">
                                    Action 100
                                </div>
                            </div>
                        </a>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
 @include('partials.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let gameLoaded = false;
        const gameUrl = "{{ $game->url ?? '' }}";
        const gameSlug = "{{ $game->slug ?? '' }}";
        const currentUrl = window.location.href;

        // Load Game
        function loadGame() {
            if (gameLoaded) return;

            const container = document.getElementById('gameContainer');
            
            if (gameUrl) {
                // If game has URL, load it in iframe
                container.innerHTML = `<iframe class="game-frame" src="${gameUrl}" allowfullscreen></iframe>`;
                
                // Track play count
                fetch(`/game/${gameSlug}/play`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(response => response.json())
                  .then(data => {
                      if (data.plays) {
                          document.getElementById('playCount').textContent = data.plays;
                      }
                  });

                // Add to recently played
                fetch(`/add-to-recently-played/100`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

                gameLoaded = true;
                document.getElementById('playBtn').innerHTML = '<i class="bi bi-pause-fill"></i> Playing...';
            } else {
                container.innerHTML = `
                    <div class="loading-spinner">
                        <div class="text-center">
                            <i class="bi bi-exclamation-triangle text-warning" style="font-size: 48px;"></i>
                            <p class="text-white mt-3">Game URL not configured yet</p>
                            <small class="text-white-50">Please contact administrator</small>
                        </div>
                    </div>
                `;
            }
        }

        // Toggle Fullscreen
        function toggleFullscreen() {
            const elem = document.querySelector('.game-frame');
            if (!elem) {
                alert('Please load the game first!');
                return;
            }

            if (!document.fullscreenElement) {
                elem.requestFullscreen().catch(err => {
                    console.error('Fullscreen error:', err);
                });
            } else {
                document.exitFullscreen();
            }
        }

        // Toggle Favorite
        function toggleFavorite() {
            const btn = event.target.closest('.btn-favorite');
            const icon = btn.querySelector('i');
            
            if (icon.classList.contains('bi-heart')) {
                icon.classList.remove('bi-heart');
                icon.classList.add('bi-heart-fill');
                btn.style.borderColor = '#ef4444';
                btn.style.color = '#ef4444';
                
                // Save to localStorage
                let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
                if (!favorites.includes('100')) {
                    favorites.push('100');
                    localStorage.setItem('favorites', JSON.stringify(favorites));
                }
            } else {
                icon.classList.remove('bi-heart-fill');
                icon.classList.add('bi-heart');
                btn.style.borderColor = '#dee2e6';
                btn.style.color = '';
                
                // Remove from localStorage
                let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
                favorites = favorites.filter(id => id !== '100');
                localStorage.setItem('favorites', JSON.stringify(favorites));
            }
        }

        // Check if already favorited on load
        document.addEventListener('DOMContentLoaded', function() {
            let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            if (favorites.includes('100')) {
                const btn = document.querySelector('.btn-favorite');
                const icon = btn.querySelector('i');
                icon.classList.remove('bi-heart');
                icon.classList.add('bi-heart-fill');
                btn.style.borderColor = '#ef4444';
                btn.style.color = '#ef4444';
            }
        });

        // Share Functions
        function shareOnFacebook() {
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(currentUrl)}`, '_blank', 'width=600,height=400');
        }

        function shareOnTwitter() {
            const text = `Check out ${document.querySelector('.game-title').textContent} on CrazyGames!`;
            window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(currentUrl)}`, '_blank', 'width=600,height=400');
        }

        function shareOnWhatsApp() {
            const text = `Check out ${document.querySelector('.game-title').textContent}: ${currentUrl}`;
            window.open(`https://wa.me/?text=${encodeURIComponent(text)}`, '_blank');
        }

        function copyLink() {
            navigator.clipboard.writeText(currentUrl).then(() => {
                const btn = event.target.closest('.share-btn');
                const originalHTML = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check-circle"></i> Copied!';
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                }, 2000);
            }).catch(err => {
                alert('Failed to copy link: ' + err);
            });
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // F for fullscreen
            if (e.key === 'f' && gameLoaded) {
                toggleFullscreen();
            }
            // Space to play/pause (if not focused on input)
            if (e.code === 'Space' && !gameLoaded && document.activeElement.tagName !== 'INPUT') {
                e.preventDefault();
                loadGame();
            }
        });
    </script>
</body>
</html>