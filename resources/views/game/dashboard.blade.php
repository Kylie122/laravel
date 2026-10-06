<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survival Dashboard</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body {
            background-color: #0f172a;
            color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .dashboard-card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 28px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h1 {
            font-size: 1.6rem;
            color: #f1f5f9;
            margin-bottom: 6px;
        }

        .player-name {
            font-size: 1.1rem;
            color: #38bdf8;
            font-weight: 500;
        }

        .day-badge {
            display: inline-block;
            background-color: #334155;
            color: #cbd5e1;
            font-size: 0.85rem;
            padding: 4px 12px;
            border-radius: 20px;
            margin-top: 8px;
            font-weight: 600;
        }

        .divider {
            border: 0;
            height: 1px;
            background: #334155;
            margin: 20px 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            text-align: left;
        }

        .stat-item {
            background-color: #0f172a;
            border: 1px solid #334155;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 0.9rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-label {
            color: #94a3b8;
        }

        .stat-value {
            font-weight: bold;
            color: #f8fafc;
        }

        .actions-title {
            font-size: 1rem;
            color: #cbd5e1;
            margin-bottom: 14px;
        }

        .actions-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px 16px;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.2s ease;
        }

        .btn:hover {
            background-color: #1d4ed8;
        }

        .btn-secondary {
            background-color: #334155;
            color: #e2e8f0;
        }

        .btn-secondary:hover {
            background-color: #475569;
        }
    </style>
</head>
<body>

    <div class="dashboard-card">
        <h1>Survival Dashboard</h1>
        <p class="player-name">Welcome, {{ $game['player_name'] }}</p>
        <div class="day-badge">Day {{ $game['day'] }} / 30</div>

        <hr class="divider">

        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-label">❤️ Health</span>
                <span class="stat-value">{{ $game['health'] }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">🍖 Food</span>
                <span class="stat-value">{{ $game['food'] }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">💧 Water</span>
                <span class="stat-value">{{ $game['water'] }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">🔫 Ammo</span>
                <span class="stat-value">{{ $game['ammo'] }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">👥 Survivors</span>
                <span class="stat-value">{{ $game['survivors'] }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">⭐ Score</span>
                <span class="stat-value">{{ $game['score'] }}</span>
            </div>
        </div>

        <hr class="divider">

        <h2 class="actions-title">What do you want to do?</h2>

        <div class="actions-group">
            <a href="{{ route('game.explore') }}" class="btn">Explore</a>
            <a href="{{ route('game.inventory') }}" class="btn btn-secondary">Inventory</a>
            <a href="{{ route('game.history') }}" class="btn btn-secondary">History</a>
        </div>
    </div>

</body>
</html>