<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Result</title>
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

        .result-card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 28px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .title-won {
            color: #4ade80;
            font-size: 1.75rem;
            margin-bottom: 8px;
        }

        .title-lost {
            color: #f87171;
            font-size: 1.75rem;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #38bdf8;
            font-weight: 500;
            font-size: 1.05rem;
            margin-bottom: 4px;
        }

        .message {
            color: #cbd5e1;
            font-size: 0.95rem;
        }

        .divider {
            border: 0;
            height: 1px;
            background: #334155;
            margin: 20px 0;
        }

        .section-title {
            font-size: 1.05rem;
            color: #cbd5e1;
            margin-bottom: 14px;
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

        .stat-full {
            grid-column: span 2;
            background-color: #111827;
            border-color: #374151;
        }

        .stat-label {
            color: #94a3b8;
        }

        .stat-value {
            font-weight: bold;
            color: #f8fafc;
        }

        .actions-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-restart {
            width: 100%;
            padding: 12px 16px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-restart:hover {
            background-color: #1d4ed8;
        }

        .btn-home {
            display: block;
            width: 100%;
            padding: 10px 16px;
            background-color: #334155;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 8px;
            transition: background-color 0.2s ease;
            text-align: center;
        }

        .btn-home:hover {
            background-color: #475569;
            color: #f8fafc;
        }
    </style>
</head>
<body>

    <div class="result-card">
        @if ($game['status'] === 'won')
            <h1 class="title-won">🎉 YOU SURVIVED!</h1>
            <p class="subtitle">Congratulations, {{ $game['player_name'] }}!</p>
            <p class="message">You survived the zombie apocalypse for 30 days.</p>
        @else
            <h1 class="title-lost">💀 GAME OVER</h1>
            <p class="message">{{ $game['player_name'] }} did not survive.</p>
        @endif

        <hr class="divider">

        <h2 class="section-title">Final Statistics</h2>

        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-label">📅 Days</span>
                <span class="stat-value">{{ $game['day'] }}</span>
            </div>
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
            <div class="stat-item stat-full">
                <span class="stat-label">⭐ Final Score</span>
                <span class="stat-value">{{ $game['score'] }}</span>
            </div>
        </div>

        <hr class="divider">

        <div class="actions-group">
            <form action="{{ route('game.restart') }}" method="POST">
                @csrf
                <button type="submit" class="btn-restart">Play Again</button>
            </form>

            <a href="{{ route('home') }}" class="btn-home">
                Home
            </a>
        </div>
    </div>

</body>
</html>
