<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Online Games on CrazyGames | Play Now!</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            /* min-height: auto; */
        }

        .container {
            display: block;
            /* min-height: auto; */
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: rgba(255, 255, 255, 0.98);
            overflow-y: auto;
            position: fixed;
            height: 100%;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .logo {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 20px;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-section {
            padding: 15px 0;
        }

        .nav-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .nav-item:hover {
            background: #f3f4f6;
            color: #667eea;
        }

        .nav-item.active {
            background: #eef2ff;
            color: #667eea;
            border-left: 3px solid #667eea;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
        }

        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 10px 0;
        }

        .category-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 5px;
            padding: 10px;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 30px;
            min-height: 100%;
        }

        .header {
            margin-bottom: 30px;
        }

        h1 {
            color: white;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .section {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }

        .view-more {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .view-more:hover {
            color: #764ba2;
        }

        /* Game Grid */
        .game-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        .game-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* THIS MAKES IT FIT */
            display: block;
        }

        .game-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            background: #f9fafb;
        }

        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .game-image {
            width: 100%;
            aspect-ratio: 16/9;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
            position: relative;
        }

        .game-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ef4444;
            color: white;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .game-info {
            padding: 15px;
        }

        .game-title {
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 5px;
            text-decoration: none;
        }

        .game-meta {
            font-size: 13px;
            color: #6b7280;
            text-decoration: none;
        }

        /* Featured Banner */
        .featured-banner {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 40px;
            margin-bottom: 30px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .banner-content h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .banner-content p {
            font-size: 16px;
            opacity: 0.9;
        }

        .banner-cta {
            background: white;
            color: #667eea;
            padding: 12px 30px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .banner-cta:hover {
            transform: scale(1.05);
        }

        /* Comet Section */
        .comet-section {
            background: linear-gradient(135deg, #1e1e1e 0%, #2d2d2d 100%);
            color: white;
        }

        .comet-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
        }

        .comet-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s;

            /* adjust as needed */
            height: 300px;
            /* adjust as needed */

            overflow: hidden;
            /* IMPORTANT */
            position: relative;
        }

        .comet-card:hover {
            transform: translateY(-3px);
        }

        .comet-badge {
            background: linear-gradient(90deg, #ff6b6b, #feca57);
            padding: 8px;
            text-align: center;
            font-size: 12px;
            font-weight: 600;
        }

        .comet-image {
            aspect-ratio: 2/3;
            background: linear-gradient(135deg, #4a5568, #718096);
        }
        .game-link {
            text-decoration: none;
            color: inherit;
        }

        /* Footer */
        .footer {
            background: rgba(255, 255, 255, 0.98);
            padding: 30px;
            margin-top: 30px;
            border-radius: 16px;
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .footer-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
        }

        .footer-link:hover {
            color: #667eea;
        }

        .copyright {
            color: #9ca3af;
            font-size: 14px;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 1001;
            background: white;
            border: none;
            padding: 8px 10px;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .mobile-menu-btn span {
            display: block;
            width: 20px;
            height: 2px;
            background: #667eea;
            margin: 4px 0;
            transition: 0.3s;
        }

        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .mobile-overlay.active {
            display: block;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
                padding: 20px;
            }

            .game-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .featured-banner {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .comet-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .mobile-menu-btn {
                display: block;
            }

            .sidebar {
                width: 280px;
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 80px 15px 15px;
            }

            .game-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            .comet-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }

            h1 {
                font-size: 24px;
            }

            .section-title {
                font-size: 20px;
            }

            .section {
                padding: 20px 15px;
            }

            .featured-banner {
                padding: 25px 20px;
            }

            .banner-content h2 {
                font-size: 22px;
            }

            .game-title {
                font-size: 14px;
            }

            .game-meta {
                font-size: 12px;
            }

        }
    </style>
</head>

<body>
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" onclick="toggleMenu()">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Mobile Overlay -->
    <div class="mobile-overlay" onclick="toggleMenu()"></div>

    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <div class="logo-icon">C</div>
                <div class="logo-text">CrazyGames</div>
            </div>

         @include('partials.nav')

            <div class="divider"></div>

            <div class="category-grid">
                <a href="#" class="nav-item">⚔️ Action</a>
                <a href="#" class="nav-item">🗺️ Adventure</a>
                <a href="#" class="nav-item">🏀 Basketball</a>
                <a href="#" class="nav-item">🚲 Bike</a>
                <a href="#" class="nav-item">🚗 Car</a>
                <a href="#" class="nav-item">🃏 Card</a>
                <a href="#" class="nav-item">🎲 Casual</a>
                <a href="#" class="nav-item">👆 Clicker</a>
                <a href="#" class="nav-item">🎮 Controller</a>
                <a href="#" class="nav-item">🏎️ Driving</a>
                <a href="#" class="nav-item">🚪 Escape</a>
                <a href="#" class="nav-item">🔫 Shooting</a>
                <a href="#" class="nav-item">⚽ Soccer</a>
                <a href="#" class="nav-item">🏆 Sports</a>
                <a href="#" class="nav-item">🧩 Puzzle</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Top picks for you</h1>
            </div>

            <!-- Featured Banner -->
            <div class="featured-banner">
                <div class="banner-content">
                    <h2>Play on Comet</h2>
                    <p>A smarter AI-powered way to play and browse</p>
                </div>
                <a href="#" class="banner-cta">Try Comet</a>
            </div>

            <!-- Featured Games -->
            <section class="section">
                <div class="section-header">
                    <h2 class="section-title">Featured games</h2>
                    <a href="#" class="view-more">View all →</a>
                </div>
                <div class="game-grid">

                    @foreach ($featuredGames as $game)
                        <div class="game-card">
                            <a class="game-link" href="{{ route('game.show', $game->slug) }}">
                                <div class="game-image"><img src="{{ asset('storage/' . $game->thumbnail) }}"
                                        alt="{{ $game->title }}">
                                </div>
                                <div class="game-info">
                                    <div class="game-title">{{ $game->title }}</div>
                                    <div class="game-meta">{{ $game->category }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </section>

            <!-- Comet Section -->
            <section class="section comet-section">
                <div class="section-header">
                    <h2 class="section-title">Play on Comet</h2>
                    <a href="#" class="view-more">View all →</a>
                </div>
                <div class="comet-grid">
                    @foreach ($comet as $cometGame)
                        <div class="comet-card">
                            <a href="{{ route('game.show', $cometGame->slug) }}" class="game-link">
                                <div class="comet-badge">Play on Comet</div>
                                <div class="comet-image"><img src="{{ asset('storage/' . $cometGame->thumbnail) }}"
                                        alt=""></div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- New Games -->
            <section class="section">
                <div class="section-header">
                    <h2 class="section-title">New games</h2>
                    <a href="#" class="view-more">View more →</a>
                </div>
                <div class="game-grid">
                    @foreach ($newGames as $ngame)
                        <div class="game-card">
                            <a class="game-link" href="{{ route('game.show', $ngame->slug) }}">
                                <div class="game-image"><img src="{{ asset('storage/' . $ngame->thumbnail) }}"
                                        alt="{{ $ngame->title }}">
                                </div>
                                <div class="game-info">
                                    <div class="game-title">{{ $ngame->title }}</div>
                                    <div class="game-meta">{{ $ngame->category }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
                 <!-- All Games -->
            <section class="section">
                <div class="section-header">
                    <h2 class="section-title">All games</h2>
                    <a href="#" class="view-more">View more →</a>
                </div>
                <div class="game-grid">
                    @foreach ($allGames as $allGame)
                        <div class="game-card">
                            <a class="game-link" href="{{ route('game.show', $allGame->slug) }}">
                                <div class="game-image"><img src="{{ asset('storage/' . $allGame->thumbnail) }}"
                                        alt="{{ $allGame->title }}">
                                </div>
                                <div class="game-info">
                                    <div class="game-title">{{ $allGame->title }}</div>
                                    <div class="game-meta">{{ $allGame->category }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Footer -->
            <footer class="footer">
                <div class="footer-links">
                    <a href="#" class="footer-link">About</a>
                    <a href="#" class="footer-link">Developers</a>
                    <a href="#" class="footer-link">Kids site</a>
                    <a href="#" class="footer-link">Jobs</a>
                    <a href="#" class="footer-link">Terms & conditions</a>
                    <a href="#" class="footer-link">Privacy</a>
                    <a href="#" class="footer-link">All games</a>
                </div>
                <div class="copyright">© 2026 CrazyGames</div>
            </footer>
        </main>
    </div>

    <script>
        function toggleMenu() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.mobile-overlay');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        // Close menu when clicking on a nav item on mobile
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', () => {
                if (window.innerWidth <= 480) {
                    toggleMenu();
                }
            });
        });
    </script>
</body>

</html>
