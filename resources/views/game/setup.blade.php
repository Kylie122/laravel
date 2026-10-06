<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Setup</title>
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

        .setup-card {
            background-color: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 28px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h1 {
            font-size: 1.6rem;
            color: #f1f5f9;
            margin-bottom: 6px;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .divider {
            border: 0;
            height: 1px;
            background: #334155;
            margin: 20px 0;
        }

        .error-box {
            background-color: #451a1a;
            border: 1px solid #f87171;
            color: #fca5a5;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            text-align: left;
            margin-bottom: 20px;
        }

        .error-list {
            padding-left: 18px;
            margin: 0;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            text-align: left;
            margin-bottom: 20px;
        }

        label {
            font-size: 0.9rem;
            color: #cbd5e1;
            font-weight: 500;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 14px;
            background-color: #0f172a;
            border: 1px solid #334155;
            border-radius: 8px;
            color: #f8fafc;
            font-size: 0.95rem;
            outline: none;
            transition: border-color 0.2s ease;
        }

        input[type="text"]:focus {
            border-color: #38bdf8;
        }

        .btn-submit {
            width: 100%;
            padding: 12px 16px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-submit:hover {
            background-color: #1d4ed8;
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

    <div class="setup-card">
        <h1>🎮 Game Setup</h1>
        <p class="subtitle">Prepare your survivor before heading out.</p>

        <hr class="divider">

        @if ($errors->any())
            <div class="error-box">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('game.start') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="player_name">Enter your name:</label>
                <input
                    id="player_name"
                    type="text"
                    name="player_name"
                    placeholder="Your name"
                    maxlength="20"
                    required
                >
            </div>

            <button type="submit" class="btn-submit">Start Survival</button>
        </form>

        <hr class="divider">

        <a href="{{ route('home') }}" class="btn-back">
            Back
        </a>
    </div>

</body>
</html>
