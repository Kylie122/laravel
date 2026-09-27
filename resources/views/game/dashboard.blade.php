<!DOCTYPE html>
<html>
<head>
    <title>Survival Dashboard</title>
</head>
<body>

    <h1>Survival Dashboard</h1>

    <h2>Welcome, {{ $game['player_name'] }}</h2>

    <h3>Day {{ $game['day'] }} / 30</h3>

    <hr>

    <p>❤️ Health: {{ $game['health'] }}</p>
    <p>🍖 Food: {{ $game['food'] }}</p>
    <p>💧 Water: {{ $game['water'] }}</p>
    <p>🔫 Ammo: {{ $game['ammo'] }}</p>
    <p>👥 Survivors: {{ $game['survivors'] }}</p>
    <p>⭐ Score: {{ $game['score'] }}</p>

    <hr>

    <h2>What do you want to do?</h2>

    <a href="{{ route('game.explore') }}">
        <button>Explore</button>
    </a>

    <a href="{{ route('game.inventory') }}">
        <button>Inventory</button>
    </a>

    <a href="{{ route('game.history') }}">
        <button>History</button>
    </a>

    <br><br>


</body>
</html>