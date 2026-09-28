<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore</title>
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

        .explore-card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 28px;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h1 {
            font-size: 1.6rem;
            color: #f1f5f9;
            margin-bottom: 6px;
        }

        .day-badge {
            display: inline-block;
            background-color: #334155;
            color: #cbd5e1;
            font-size: 0.85rem;
            padding: 4px 12px;
            border-radius: 20px;
            margin-top: 4px;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .prompt-text {
            color: #94a3b8;
            font-size: 0.95rem;
            margin-bottom: 16px;
        }

        .divider {
            border: 0;
            height: 1px;
            background: #334155;
            margin: 20px 0;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 10px;
        }

        .btn-action {
            width: 100%;
            padding: 12px 14px;
            background-color: #0f172a;
            color: #f8fafc;
            border: 1px solid #334155;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-action:hover {
            background-color: #2563eb;
            border-color: #3b82f6;
        }

        .btn-full {
            grid-column: span 2;
        }

        .btn-back {
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

        .btn-back:hover {
            background-color: #475569;
            color: #f8fafc;
        }
    </style>
</head>
<body>

    <div class="explore-card">
        <h1>Explore Area</h1>
        <div class="day-badge">Day {{ $game['day'] }}</div>
        <p class="prompt-text">Choose what you want to search for.</p>

        <hr class="divider">

        <form action="{{ route('game.action') }}" method="POST">
            @csrf

            <div class="actions-grid">
                <button type="submit" name="action" value="food" class="btn-action">
                    🍖 Search Food
                </button>

                <button type="submit" name="action" value="water" class="btn-action">
                    💧 Search Water
                </button>

                <button type="submit" name="action" value="weapon" class="btn-action">
                    🔫 Search Weapons
                </button>

                <button type="submit" name="action" value="medicine" class="btn-action">
                    💊 Search Medicine
                </button>

                <button type="submit" name="action" value="explore" class="btn-action btn-full">
                    🗺️ Explore Area
                </button>

                <button type="submit" name="action" value="rest" class="btn-action btn-full">
                    💤 Rest
                </button>
            </div>
        </form>

        <hr class="divider">

        <a href="{{ route('game.dashboard') }}" class="btn-back">
            Back to Dashboard
        </a>
    </div>

</body>
</html>
