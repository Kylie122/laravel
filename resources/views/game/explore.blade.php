<!DOCTYPE html>
<html>
<head>
    <title>Explore</title>
</head>
<body>

    <h1>Explore</h1>

    <p>Day {{ $game['day'] }}</p>

    <p>Choose what you want to search for.</p>

    <form action="{{ route('game.action') }}" method="POST">
        @csrf

        <button type="submit" name="action" value="food">
            Search for Food
        </button>

        <button type="submit" name="action" value="water">
            Search for Water
        </button>

        <button type="submit" name="action" value="weapon">
            Search for Weapons
        </button>

        <button type="submit" name="action" value="medicine">
            Search for Medicine
        </button>

        <button type="submit" name="action" value="explore">
            Explore Area
        </button>

        <button type="submit" name="action" value="rest">
            Rest
        </button>
    </form>

    <br>

    <a href="{{ route('game.dashboard') }}">
        Back to Dashboard
    </a>

</body>
</html>