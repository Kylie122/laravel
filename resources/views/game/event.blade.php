
<!DOCTYPE html>
<html>
<head>
    <title>Event Result</title>
</head>
<body>

    @php
        $choiceEvent = session('choice_event');
    @endphp

    @if ($choiceEvent)

        <h1>{{ $choiceEvent['title'] }}</h1>

        <p>{{ $choiceEvent['message'] }}</p>

        <hr>

        <h2>What will you do?</h2>

        <form action="{{ route('game.choice') }}" method="POST">
            @csrf

            @foreach ($choiceEvent['choices'] as $key => $choice)

                <button type="submit" name="choice" value="{{ $key }}">
                    {{ $choice['text'] }}
                </button>

                <br><br>

            @endforeach

        </form>

    @else

        <h1>{{ $event['title'] }}</h1>

        <p>{{ $event['message'] }}</p>

        <hr>

        <h2>Changes</h2>

        @if ($event['health'] != 0)
            <p>
                ❤️ Health:
                {{ $event['health'] > 0 ? '+' : '' }}{{ $event['health'] }}
            </p>
        @endif

        @if ($event['food'] != 0)
            <p>
                🍖 Food:
                {{ $event['food'] > 0 ? '+' : '' }}{{ $event['food'] }}
            </p>
        @endif

        @if ($event['water'] != 0)
            <p>
                💧 Water:
                {{ $event['water'] > 0 ? '+' : '' }}{{ $event['water'] }}
            </p>
        @endif

        @if ($event['ammo'] != 0)
            <p>
                🔫 Ammo:
                {{ $event['ammo'] > 0 ? '+' : '' }}{{ $event['ammo'] }}
            </p>
        @endif

        @if ($event['survivors'] != 0)
            <p>
                👥 Survivors:
                {{ $event['survivors'] > 0 ? '+' : '' }}{{ $event['survivors'] }}
            </p>
        @endif

        @if ($event['score'] != 0)
            <p>
                ⭐ Score:
                {{ $event['score'] > 0 ? '+' : '' }}{{ $event['score'] }}
            </p>
        @endif

        @if ($event['item'])
            <p>🎒 Item found: {{ $event['item'] }}</p>
        @endif

        <hr>

        @if ($game['status'] === 'dead')

            <h2>You died!</h2>

            <a href="{{ route('game.result') }}">
                <button>View Result</button>
            </a>

        @elseif ($game['status'] === 'won')

            <h2>You survived!</h2>

            <a href="{{ route('game.result') }}">
                <button>View Result</button>
            </a>

        @else

            <a href="{{ route('game.dashboard') }}">
                <button>Return to Dashboard</button>
            </a>

        @endif

    @endif

</body>
</html>
