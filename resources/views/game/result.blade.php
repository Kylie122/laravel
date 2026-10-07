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
            /* Added: Radial glow background shifting based on win/loss dynamic accents */
            background-image: 
                radial-gradient(circle at 50% 30%, {{ $game['status'] === 'won' ? 'rgba(34, 197, 94, 0.15)' : 'rgba(239, 68, 68, 0.15)' }} 0%, transparent 60%),
                radial-gradient(circle at 80% 80%, rgba(15, 23, 42, 0.9) 0%, transparent 50%);
            position: relative;
            overflow-x: hidden;
        }

        /* Added: Subtle background grid texture */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 0);
            background-size: 24px 24px;
            pointer-events: none;
            z-index: 0;
        }

        .result-card {
            position: relative;
            z-index: 1;
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 28px;
            width: 100%;
            max-width: 460px;
            /* Enhanced box-shadow with status glow */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4), 
                        0 0 40px {{ $game['status'] === 'won' ? 'rgba(74, 222, 128, 0.08)' : 'rgba(248, 113, 113, 0.08)' }};
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .result-card:hover {
            border-color: #475569;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5), 
                        0 0 50px {{ $game['status'] === 'won' ? 'rgba(74, 222, 128, 0.12)' : 'rgba(248, 113, 113, 0.12)' }};
        }

        .title-won {
            color: #4ade80;
            font-size: 1.75rem;
            margin-bottom: 8px;
            text-shadow: 0 0 16px rgba(74, 222, 128, 0.3);
            animation: fadeIn 0.5s ease-out;
        }

        .title-lost {
            color: #f87171;
            font-size: 1.75rem;
            margin-bottom: 8px;
            text-shadow: 0 0 16px rgba(248, 113, 113, 0.3);
            animation: fadeIn 0.5s ease-out;
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
            background: linear-gradient(90deg, transparent, #334155 20%, #334155 80%, transparent);
            margin: 20px 0;
        }

        .section-title {
            font-size: 1.05rem;
            color: #cbd5e1;
            margin-bottom: 14px;
            letter-spacing: 0.5px;
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
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.9rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: border-color 0.2s ease, transform 0.2s ease;
        }

        .stat-item:hover {
            border-color: #475569;
            transform: translateY(-1px);
        }

        .stat-full {
            grid-column: span 2;
            background: linear-gradient(135deg, #111827 0%, #1e1b4b 100%);
            border-color: #4338ca;
            padding: 12px 16px;
            box-shadow: 0 4px 12px rgba(67, 56, 202, 0.15);
        }

        .stat-full:hover {
            border-color: #6366f1;
        }

        .stat-full .stat-label {
            color: #c7d2fe;
            font-weight: 500;
        }

        .stat-full .stat-value {
            color: #38bdf8;
            font-size: 1.1rem;
            text-shadow: 0 0 10px rgba(56, 189, 248, 0.3);
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
            transition: background-color 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-restart:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
        }

        .btn-restart:active {
            transform: translateY(0);
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
            transition: background-color 0.2s ease, color 0.2s ease, transform 0.15s ease;
            text-align: center;
        }

        .btn-home:hover {
            background-color: #475569;
            color: #f8fafc;
            transform: translateY(-1px);
        }

        .btn-home:active {
            transform: translateY(0);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
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