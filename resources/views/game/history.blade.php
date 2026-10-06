<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survival History</title>
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

        .history-card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 28px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h1 {
            font-size: 1.6rem;
            color: #f1f5f9;
        }

        .divider {
            border: 0;
            height: 1px;
            background: #334155;
            margin: 20px 0;
        }

        .history-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-height: 320px;
            overflow-y: auto;
            padding-right: 4px;
            text-align: left;
        }

        .history-item {
            background-color: #0f172a;
            border: 1px solid #334155;
            border-left: 3px solid #38bdf8;
            padding: 12px 14px;
            border-radius: 6px;
            font-size: 0.9rem;
            color: #cbd5e1;
            line-height: 1.4;
        }

        .empty-history {
            color: #64748b;
            font-style: italic;
            padding: 20px 0;
            font-size: 0.95rem;
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

    <div class="history-card">
        <h1>Survival Log</h1>

        <hr class="divider">

        @if (count($game['history']) > 0)
            <ul class="history-list">
                @foreach ($game['history'] as $history)
                    <li class="history-item">{{ $history }}</li>
                @endforeach
            </ul>
        @else
            <p class="empty-history">No history recorded yet.</p>
        @endif

        <hr class="divider">

        <a href="{{ route('game.dashboard') }}" class="btn-back">
            Back to Dashboard
        </a>
    </div>

</body>
</html>