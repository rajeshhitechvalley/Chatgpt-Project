 <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-icon">C</div>
                    <div>
                        <div class="logo-text">CrazyGames</div>
                        <span class="admin-badge">Admin Panel</span>
                    </div>
                </div>
            </div>

            <nav class="nav-section">
                <div class="nav-title">Main</div>
                <a href="{{ route('dashboard') }}" class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('games.index') }}" class="nav-item {{ Route::is('games.index') ? 'active' : '' }}">
                    <span class="nav-icon">🎮</span>
                    <span>Games</span>
                </a>
                <a href="" class="nav-item">
                    <span class="nav-icon">👥</span>
                    <span>Users</span>
                </a>
                <a href="" class="nav-item">
                    <span class="nav-icon">📈</span>
                    <span>Analytics</span>
                </a>
            </nav>

            <nav class="nav-section">
                <div class="nav-title">Content</div>
                <a href="#" class="nav-item">
                    <span class="nav-icon">📝</span>
                    <span>Categories</span>
                </a>
                <a href="#" class="nav-item">
                    <span class="nav-icon">🏷️</span>
                    <span>Tags</span>
                </a>
                <a href="#" class="nav-item">
                    <span class="nav-icon">💬</span>
                    <span>Reviews</span>
                </a>
                <a href="#" class="nav-item">
                    <span class="nav-icon">🎨</span>
                    <span>Media</span>
                </a>
            </nav>

            <nav class="nav-section">
                <div class="nav-title">Settings</div>
                <a href="#" class="nav-item">
                    <span class="nav-icon">⚙️</span>
                    <span>Settings</span>
                </a>
                <a href="#" class="nav-item">
                    <span class="nav-icon">🔐</span>
                    <span>Security</span>
                </a>
                <a href="#" class="nav-item">
                    <span class="nav-icon">🚪</span>
                    <span>Logout</span>
                </a>
            </nav>
        </aside>