<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CrazyGames</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f7fa;
            color: #333;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 20px;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 700;
        }

        .admin-badge {
            background: rgba(102, 126, 234, 0.2);
            color: #a78bfa;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            margin-top: 8px;
            display: inline-block;
        }

        .nav-section {
            padding: 20px 0;
        }

        .nav-title {
            padding: 0 20px;
            font-size: 11px;
            text-transform: uppercase;
            color: #94a3b8;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .nav-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: white;
        }

        .nav-item.active {
            background: rgba(102, 126, 234, 0.15);
            color: #a78bfa;
            border-left: 3px solid #667eea;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            font-size: 18px;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1001;
            background: white;
            border: none;
            padding: 8px 10px;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .mobile-menu-btn span {
            display: block;
            width: 20px;
            height: 2px;
            background: #667eea;
            margin: 4px 0;
        }

        .mobile-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        .mobile-overlay.active {
            display: block;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 0;
        }

        /* Top Bar */
        .top-bar {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .search-box {
            flex: 1;
            max-width: 400px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            background: #f8fafc;
        }

        .search-box input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
        }

        .top-bar-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification-btn {
            position: relative;
            background: #f8fafc;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            transition: background 0.2s;
        }

        .notification-btn:hover {
            background: #e2e8f0;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: white;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
            transition: background 0.2s;
        }

        .user-profile:hover {
            background: #f8fafc;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
        }

        .user-role {
            font-size: 12px;
            color: #64748b;
        }

        /* Content Area */
        .content-area {
            padding: 30px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 14px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-icon.purple {
            background: rgba(102, 126, 234, 0.1);
        }

        .stat-icon.blue {
            background: rgba(59, 130, 246, 0.1);
        }

        .stat-icon.green {
            background: rgba(34, 197, 94, 0.1);
        }

        .stat-icon.orange {
            background: rgba(249, 115, 22, 0.1);
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        .stat-trend.up {
            color: #22c55e;
        }

        .stat-trend.down {
            color: #ef4444;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .stat-label {
            color: #64748b;
            font-size: 14px;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .card-header {
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
        }

        .card-action {
            color: #667eea;
            font-size: 14px;
            text-decoration: none;
            font-weight: 500;
        }

        .card-body {
            padding: 20px;
        }

        /* Table */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            text-align: left;
            padding: 12px;
            font-size: 12px;
            text-transform: uppercase;
            color: #64748b;
            font-weight: 600;
            border-bottom: 1px solid #f1f5f9;
        }

        tbody td {
            padding: 16px 12px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .game-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .game-thumb {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.active {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .status-badge.pending {
            background: rgba(249, 115, 22, 0.1);
            color: #f97316;
        }

        .status-badge.inactive {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        /* Activity List */
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .activity-item {
            display: flex;
            gap: 12px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .activity-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-size: 14px;
            color: #334155;
            margin-bottom: 4px;
        }

        .activity-time {
            font-size: 12px;
            color: #94a3b8;
        }

        /* Button */
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 240px;
            }

            .main-content {
                margin-left: 240px;
            }

            .top-bar {
                padding: 15px 20px;
            }

            .content-area {
                padding: 20px;
            }

            .user-info {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .mobile-menu-btn {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .search-box {
                display: none;
            }

            .top-bar-actions {
                gap: 10px;
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

    <div class="dashboard-container">
        <!-- Sidebar -->
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
                <a href="#" class="nav-item active">
                    <span class="nav-icon">📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="nav-item">
                    <span class="nav-icon">🎮</span>
                    <span>Games</span>
                </a>
                <a href="#" class="nav-item">
                    <span class="nav-icon">👥</span>
                    <span>Users</span>
                </a>
                <a href="#" class="nav-item">
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

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="search-box">
                    <input type="text" placeholder="Search games, users, analytics...">
                </div>
                <div class="top-bar-actions">
                    <button class="notification-btn">
                        🔔
                        <span class="notification-badge">12</span>
                    </button>
                    <div class="user-profile">
                        <div class="user-avatar">AD</div>
                        <div class="user-info">
                            <div class="user-name">Admin User</div>
                            <div class="user-role">Super Admin</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <div class="page-header">
                    <h1 class="page-title">Dashboard Overview</h1>
                    <p class="page-subtitle">Welcome back! Here's what's happening with your games today.</p>
                </div>

                <!-- Stats Grid -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon purple">🎮</div>
                            <div class="stat-trend up">↑ 12%</div>
                        </div>
                        <div class="stat-value">4,523</div>
                        <div class="stat-label">Total Games</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon blue">👥</div>
                            <div class="stat-trend up">↑ 8%</div>
                        </div>
                        <div class="stat-value">1.2M</div>
                        <div class="stat-label">Active Users</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon green">📊</div>
                            <div class="stat-trend up">↑ 23%</div>
                        </div>
                        <div class="stat-value">8.5M</div>
                        <div class="stat-label">Total Plays Today</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon orange">⭐</div>
                            <div class="stat-trend down">↓ 3%</div>
                        </div>
                        <div class="stat-value">4.8</div>
                        <div class="stat-label">Average Rating</div>
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="content-grid">
                    <!-- Recent Games -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Games</h3>
                            <a href="#" class="card-action">View all →</a>
                        </div>
                        <div class="card-body">
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Game</th>
                                            <th>Category</th>
                                            <th>Plays</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="game-cell">
                                                    <div class="game-thumb">🧟</div>
                                                    <div>
                                                        <div style="font-weight: 600;">Jackal Zombie</div>
                                                        <div style="font-size: 12px; color: #94a3b8;">Added 2 hours ago</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Action</td>
                                            <td>12.5K</td>
                                            <td><span class="status-badge active">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="game-cell">
                                                    <div class="game-thumb">🏈</div>
                                                    <div>
                                                        <div style="font-weight: 600;">Big Hit Football</div>
                                                        <div style="font-size: 12px; color: #94a3b8;">Added 5 hours ago</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Sports</td>
                                            <td>8.2K</td>
                                            <td><span class="status-badge active">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="game-cell">
                                                    <div class="game-thumb">🍉</div>
                                                    <div>
                                                        <div style="font-weight: 600;">Merge a Fruit</div>
                                                        <div style="font-size: 12px; color: #94a3b8;">Added 1 day ago</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Puzzle</td>
                                            <td>15.8K</td>
                                            <td><span class="status-badge pending">Pending</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="game-cell">
                                                    <div class="game-thumb">⛏️</div>
                                                    <div>
                                                        <div style="font-weight: 600;">Dig out of Prison</div>
                                                        <div style="font-size: 12px; color: #94a3b8;">Added 2 days ago</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Adventure</td>
                                            <td>9.3K</td>
                                            <td><span class="status-badge active">Active</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Activity</h3>
                            <a href="#" class="card-action">View all →</a>
                        </div>
                        <div class="card-body">
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-icon">🎮</div>
                                    <div class="activity-content">
                                        <div class="activity-text"><strong>New game added</strong> - Jackal Zombie Survival</div>
                                        <div class="activity-time">2 hours ago</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">👤</div>
                                    <div class="activity-content">
                                        <div class="activity-text"><strong>New user registered</strong> - 523 new users today</div>
                                        <div class="activity-time">4 hours ago</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">⭐</div>
                                    <div class="activity-content">
                                        <div class="activity-text"><strong>New review</strong> - Big Hit Football received 5 stars</div>
                                        <div class="activity-time">6 hours ago</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">📊</div>
                                    <div class="activity-content">
                                        <div class="activity-text"><strong>Milestone reached</strong> - 1M plays this month</div>
                                        <div class="activity-time">1 day ago</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon">🎨</div>
                                    <div class="activity-content">
                                        <div class="activity-text"><strong>Media uploaded</strong> - 12 new game screenshots</div>
                                        <div class="activity-time">2 days ago</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quick Actions</h3>
                    </div>
                    <div class="card-body" style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <button class="btn btn-primary">➕ Add New Game</button>
                        <button class="btn btn-primary">📝 Create Category</button>
                        <button class="btn btn-primary">📊 View Reports</button>
                        <button class="btn btn-primary">⚙️ Manage Settings</button>
                    </div>
                </div>
            </div>
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