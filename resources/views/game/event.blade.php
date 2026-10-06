<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($choiceEvent) ? 'Event Choice' : 'Event Result' }}</title>
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

        .event-card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 28px;
            width: 100%;
            max-width: 520px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-size: 1.6rem;
            color: #f1f5f9;
            margin-bottom: 8px;
        }

        h2 {
            font-size: 1.1rem;
            margin-bottom: 12px;
        }

        .day-badge {
            display: inline-block;
            background-color: #334155;
            color: #cbd5e1;
            font-size: 0.85rem;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 16px;
            font-weight: 600;
        }

        .message {
            color: #cbd5e1;
            line-height: 1.5;
        }

        .divider {
            border: 0;
            height: 1px;
            background: #334155;
            margin: 20px 0;
        }

        .changes {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .change-item {
            background-color: #0f172a;
            border: 1px solid #334155;
            border-radius: 8px;
            padding: 12px;
            color: #cbd5e1;
        }

        .change-value {
            display: block;
            color: #f8fafc;
            font-weight: 700;
            margin-top: 4px;
        }

        .actions {
            display: grid;
            gap: 10px;
        }

        .button {
            display: block;
            width: 100%;
            border: 0;
            border-radius: 8px;
            padding: 12px 16px;
            background-color: #2563eb;
            color: #fff;
            text-align: center;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
        }

        .button:hover {
            background-color: #1d4ed8;
        }

        .button-secondary {
            background-color: #334155;
        }

        .button-secondary:hover {
            background-color: #475569;
        }
    </style>
</head>
<body>
    <main class="event-card">
        @if (isset($choiceEvent))
            <h1>{{ $choiceEvent['title'] }}</h1>
            <div class="day-badge">Day {{ $game['day'] }}</div>
            <p class="message">{{ $choiceEvent['message'] }}</p>

            <hr class="divider">

            <h2>What will you do?</h2>
            <form action="{{ route('game.choice') }}" method="POST" class="actions">
                @csrf
                @foreach ($choiceEvent['choices'] as $key => $choice)
                    <button type="submit" name="choice" value="{{ $key }}" class="button">
                        {{ $choice['text'] }}
                    </button>
                @endforeach
            </form>
        @else
            <h1>
                @if ($game['status'] === 'won')
                    🎉 You survived!
                @elseif ($game['status'] === 'dead')
                    💀 Game over
                @else
                    Event Result
                @endif
            </h1>
            <div class="day-badge">Day {{ max(1, $game['day'] - 1) }}</div>
            <h2>{{ $event['title'] }}</h2>
            <p class="message">{{ $event['message'] }}</p>

            <hr class="divider">

            <h2>Changes</h2>
            <div class="changes">
                @foreach (['health' => '❤️ Health', 'food' => '🍖 Food', 'water' => '💧 Water', 'ammo' => '🔫 Ammo', 'survivors' => '👥 Survivors', 'score' => '⭐ Score'] as $key => $label)
                    <div class="change-item">
                        {{ $label }}
                        <span class="change-value">{{ $event[$key] > 0 ? '+' : '' }}{{ $event[$key] }}</span>
                    </div>
                @endforeach
                @if ($event['item'])
                    <div class="change-item">
                        🎒 Item found
                        <span class="change-value">{{ $event['item'] }}</span>
                    </div>
                @endif
            </div>

            <hr class="divider">

            <div class="actions">
                <a href="{{ $game['status'] === 'playing' ? route('game.dashboard') : route('game.result') }}" class="button">
                    {{ $game['status'] === 'playing' ? 'Continue' : 'View Final Results' }}
                </a>
                @if ($game['status'] === 'playing')
                    <a href="{{ route('game.history') }}" class="button button-secondary">View History</a>
                @endif
            </div>
        @endif
    </main>
</body>
</html>
