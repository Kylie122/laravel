<!DOCTYPE html>
<html>
<head>
    <title>Game Setup</title>
</head>
<body>

    <h1>Game Setup</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('game.start') }}" method="POST">
        @csrf

        <label>Enter your name:</label>

        <input
            type="text"
            name="player_name"
            placeholder="Your name"
            maxlength="20"
            required
        >

        <button type="submit">Start Survival</button>
    </form>

    <br>

    <a href="{{ route('home') }}">Back</a>

</body>
</html>