<!DOCTYPE html>
<html>
<head>
    <title>Best Scores - Zombie Survival</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0b0b0b;
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .background {
            position: fixed;
            inset: 0;
            background:
                linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.9)),
                radial-gradient(circle at center, #3a0000 0%, #0b0b0b 65%);
            z-index: -1;
        }

        .score-card {
            width: 100%;
            max-width: 700px;
            background: rgba(20, 20, 20, 0.95);
            border: 1px solid #3b3b3b;
            border-radius: 25px;
            padding: 45px;
            box-shadow: 0 0 50px rgba(120, 0, 0, 0.25);
        }

        .title {
            text-align: center;
            font-size: 45px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .title span {
            color: #c00000;
        }

        .subtitle {
            text-align: center;
            color: #aaa !important;
            margin-bottom: 35px;
        }

        .score-list {
            background: #151515;
            border: 1px solid #333;
            border-radius: 15px;
            overflow: hidden;
        }

        .score-row {
            display: flex;
            align-items: center;
            padding: 18px 20px;
            border-bottom: 1px solid #333;
        }

        .score-row:last-child {
            border-bottom: none;
        }

        .rank {
            width: 60px;
            font-size: 22px;
            font-weight: bold;
        }

        .player {
            flex: 1;
            font-size: 18px;
        }

        .score {
            color: #e00000;
            font-size: 22px;
            font-weight: bold;
        }

        .empty {
            text-align: center;
            padding: 40px 20px;
            color: #888;
        }

        .back-btn {
            display: block;
            width: 100%;
            padding: 15px;
            margin-top: 25px;
            background: #a00000;
            color: white;
            border-radius: 12px;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            transition: 0.2s;
        }

        .back-btn:hover {
            background: #d00000;
            color: white;
            transform: translateY(-2px);
        }

        @media (max-width: 600px) {
            .score-card {
                padding: 30px 20px;
            }

            .title {
                font-size: 34px;
            }

            .rank {
                width: 45px;
            }

            .score {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

<div class="background"></div>

<div class="score-card">

    <h1 class="title">
        🏆 Best <span>Scores</span>
    </h1>

    <p class="subtitle">
       The highest-scoring survivors.
    </p>

    <div class="score-list">

        @forelse($scores as $index => $record)

            <div class="score-row">

                <div class="rank">
                    @if($index == 0)
                        🥇
                    @elseif($index == 1)
                        🥈
                    @elseif($index == 2)
                        🥉
                    @else
                        #{{ $index + 1 }}
                    @endif
                </div>

                <div class="player">
                    {{ $record->name ?? 'Survivor' }}
                </div>

                <div class="score">
                    {{ $record->score }}
                </div>

            </div>

        @empty

            <div class="empty">
                <div style="font-size: 45px;">🧟</div>
                <h4>No scores yet</h4>
                <p>Be the first survivor to make the leaderboard!</p>
            </div>

        @endforelse

    </div>

    <a href="{{ route('home') }}" class="back-btn">
        ← Back to Main Menu
    </a>

</div>

</body>
</html>
