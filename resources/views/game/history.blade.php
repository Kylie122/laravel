<!DOCTYPE html>
<html>
<head>
    <title>Survival History</title>
</head>
<body>

    <h1>Survival History</h1>

    @if (count($game['history']) > 0)

        <ul>
            @foreach ($game['history'] as $history)
                <li>{{ $history }}</li>
            @endforeach
        </ul>

    @else

        <p>No history yet.</p>

    @endif

    <br>

    <a href="{{ route('game.dashboard') }}">
        Back to Dashboard
    </a>

</body>
</html>