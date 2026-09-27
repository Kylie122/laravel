<!DOCTYPE html>
<html>
<head>
    <title>Game Result</title>
</head>
<body>

    @if ($game['status'] === 'won')

        <h1>🎉 YOU SURVIVED!</h1>

        <p>Congratulations, {{ $game['player_name'] }}!</p>

        <p>You survived the zombie apocalypse for 30 days.</p>

    @else

        <h1>💀 GAME OVER</h1>

        <p>{{ $game['player_name'] }} did not survive.</p>

    @endif

    <hr>

    <h2>Final Statistics</h2>

    <p>Days Survived: {{ $game['day'] }}</p>
    <p>Health: {{ $game['health'] }}</p>
    <p>Food: {{ $game['food'] }}</p>
    <p>Water: {{ $game['water'] }}</p>
    <p>Ammo: {{ $game['ammo'] }}</p>
    <p>Survivors: {{ $game['survivors'] }}</p>
    <p>Final Score: {{ $game['score'] }}</p>

    <hr>

    <form action="{{ route('game.restart') }}" method="POST">
        @csrf
        <button type="submit">Play Again</button>
    </form>

    <br>

    <a href="{{ route('home') }}">
        Home
    </a>

</body>
</html>