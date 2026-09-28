<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Result</title>
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
            max-width: 460px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h1 {
            font-size: 1.5rem;
            color: #f1f5f9;
            margin-bottom: 10px;
        }

        .event-message {
            color: #94a3b8;
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .divider {
            border: 0;
            height: 1px;
            background: #334155;
            margin: 20px 0;
        }

        .section-title {
            font-size: 1rem;
            color: #cbd5e1;
            margin-bottom: 14px;
        }

        .choices-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-choice {
            width: 100%;
            padding: 12px 16px;
            background-color: #334155;
            color: #f8fafc;
            border: 1px solid #475569;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-align: center;
        }

        .btn-choice:hover {
            background-color: #2563eb;
            border-color: #3b82f6;
        }

        .changes-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-bottom: 12px;
        }

        .change-item {
            background-color: #0f172a;
            border: 1px solid #334155;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.9rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .val-positive {
            color: #4ade80;
            font-weight: bold;
        }

        .val-negative {
            color: #f87171;
            font-weight: bold;
        }

        .item-found {
            background-color: #1e1b4b;
            border: 1px solid #4338ca;
            color: #c7d2fe;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.9rem;
            margin-top: 8px;
            font-weight: 500;
        }

        .btn-nav {
            display: block;
            width: 100%;
            padding: 12px 16px;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-nav:hover {
            background-color: #1d4ed8;
        }

        .status-dead {
            color: #f87171;
            font-size: 1.3rem;
            margin-bottom: 12px;
        }

        .status-won {
            color: #4ade80;
            font-size: 1.3rem;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>

    <div class="event-card">

        @php
            $choiceEvent = session('choice_event');
        @endphp

        @if ($choiceEvent)

            <h1>{{ $choiceEvent['title'] }}</h1>
            <p class="event-message">{{ $choiceEvent['message'] }}</p>

            <hr class="divider">

            <h2 class="section-title">What will you do?</h2>

            <form action="{{ route('game.choice') }}" method="POST" class="choices-group">
                @csrf

                @foreach ($choiceEvent['choices'] as $key => $choice)
                    <button type="submit" name="choice" value="{{ $key }}" class="btn-choice">
                        {{ $choice['text'] }}
                    </button>
                @endforeach
            </form>

        @else

            <h1>{{ $event['title'] }}</h1>
            <p class="event-message">{{ $event['message'] }}</p>

            <hr class="divider">

            <h2 class="section-title">Changes</h2>

            <div class="changes-list">
                @if ($event['health'] != 0)
                    <div class="change-item">
                        <span>❤️ Health</span>
                        <span class="{{ $event['health'] > 0 ? 'val-positive' : 'val-negative' }}">
                            {{ $event['health'] > 0 ? '+' : '' }}{{ $event['health'] }}
                        </span>
                    </div>
                @endif

                @if ($event['food'] != 0)
                    <div class="change-item">
                        <span>🍖 Food</span>
                        <span class="{{ $event['food'] > 0 ? 'val-positive' : 'val-negative' }}">
                            {{ $event['food'] > 0 ? '+' : '' }}{{ $event['food'] }}
                        </span>
                    </div>
                @endif

                @if ($event['water'] != 0)
                    <div class="change-item">
                        <span>💧 Water</span>
                        <span class="{{ $event['water'] > 0 ? 'val-positive' : 'val-negative' }}">
                            {{ $event['water'] > 0 ? '+' : '' }}{{ $event['water'] }}
                        </span>
                    </div>
                @endif

                @if ($event['ammo'] != 0)
                    <div class="change-item">
                        <span>🔫 Ammo</span>
                        <span class="{{ $event['ammo'] > 0 ? 'val-positive' : 'val-negative' }}">
                            {{ $event['ammo'] > 0 ? '+' : '' }}{{ $event['ammo'] }}
                        </span>
                    </div>
                @endif

                @if ($event['survivors'] != 0)
                    <div class="change-item">
                        <span>👥 Survivors</span>
                        <span class="{{ $event['survivors'] > 0 ? 'val-positive' : 'val-negative' }}">
                            {{ $event['survivors'] > 0 ? '+' : '' }}{{ $event['survivors'] }}
                        </span>
                    </div>
                @endif

                @if ($event['score'] != 0)
                    <div class="change-item">
                        <span>⭐ Score</span>
                        <span class="{{ $event['score'] > 0 ? 'val-positive' : 'val-negative' }}">
                            {{ $event['score'] > 0 ? '+' : '' }}{{ $event['score'] }}
                        </span>
                    </div>
                @endif
            </div>

            @if ($event['item'])
                <div class="item-found">🎒 Item found: {{ $event['item'] }}</div>
            @endif

            <hr class="divider">

            @if ($game['status'] === 'dead')

                <h2 class="status-dead">☠️ You died!</h2>
                <a href="{{ route('game.result') }}">
                    <button class="btn-nav">View Result</button>
                </a>

            @elseif ($game['status'] === 'won')

                <h2 class="status-won">🎉 You survived!</h2>
                <a href="{{ route('game.result') }}">
                    <button class="btn-nav">View Result</button>
                </a>

            @else

                <a href="{{ route('game.dashboard') }}">
                    <button class="btn-nav">Return to Dashboard</button>
                </a>

            @endif

        @endif

    </div>

</body>
</html>
