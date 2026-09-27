<!DOCTYPE html>
<html>
<head>
    <title>Inventory</title>
</head>
<body>

    <h1>Inventory</h1>

    @if (count($game['inventory']) > 0)

        <ul>
            @foreach ($game['inventory'] as $item => $amount)
                <li>
                    {{ $item }}: {{ $amount }}
                </li>
            @endforeach
        </ul>

    @else

        <p>Your inventory is empty.</p>

    @endif

    <br>

    <a href="{{ route('game.dashboard') }}">
        Back to Dashboard
    </a>

</body>
</html>