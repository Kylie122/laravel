<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
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

        .inventory-card {
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
            font-size: 1.6rem;
            color: #f1f5f9;
        }

        .divider {
            border: 0;
            height: 1px;
            background: #334155;
            margin: 20px 0;
        }

        .inventory-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-height: 320px;
            overflow-y: auto;
            padding-right: 4px;
        }

        .inventory-item {
            background-color: #0f172a;
            border: 1px solid #334155;
            padding: 12px 16px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.95rem;
        }

        .item-name {
            color: #e2e8f0;
            font-weight: 500;
            text-transform: capitalize;
        }

        .item-amount {
            background-color: #334155;
            color: #38bdf8;
            font-weight: bold;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 0.85rem;
        }

        .empty-inventory {
            color: #64748b;
            font-style: italic;
            padding: 20px 0;
            font-size: 0.95rem;
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

    <div class="inventory-card">
        <h1>🎒 Inventory</h1>

        <hr class="divider">

        @if (count($game['inventory']) > 0)
            <ul class="inventory-list">
                @foreach ($game['inventory'] as $item => $amount)
                    <li class="inventory-item">
                        <span class="item-name">{{ $item }}</span>
                        <span class="item-amount">x{{ $amount }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="empty-inventory">Your inventory is empty.</p>
        @endif

        <hr class="divider">

        <a href="{{ route('game.dashboard') }}" class="btn-back">
            Back to Dashboard
        </a>
    </div>

</body>
</html>
