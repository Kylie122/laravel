<!DOCTYPE html>
<html>
<head>
    <title>Zombie Survival</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0b0b0b;
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .background {
            position: fixed;
            inset: 0;
            background:
                linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.9)),
                radial-gradient(circle at center, #3a0000 0%, #0b0b0b 65%);
            z-index: -1;
        }

        .container-game {
            width: 100%;
            max-width: 850px;
            padding: 20px;
        }

        .game-card {
            background: rgba(20, 20, 20, 0.95);
            border: 1px solid #3b3b3b;
            border-radius: 25px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 0 50px rgba(120, 0, 0, 0.25);
        }

        .zombie-icon {
            font-size: 85px;
            margin-bottom: 15px;
        }

        .title {
            font-size: 58px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .title span {
            color: #c00000;
        }

        .subtitle {
            color: #aaa !important;
            font-size: 20px;
            margin-bottom: 35px;
        }

        .warning {
            background: #241010;
            border: 1px solid #612020;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 30px;
            color: #ddd;
        }

        .warning strong {
            color: #e00000;
        }

        .start-btn {
            display: inline-block;
            width: 100%;
            max-width: 350px;
            padding: 17px 30px;
            background: #a00000;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 20px;
            font-weight: bold;
            text-decoration: none;
            transition: 0.2s;
        }

        .start-btn:hover {
            background: #d00000;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(200, 0, 0, 0.3);
        }

        .features {
            margin-top: 40px;
            border-top: 1px solid #333;
            padding-top: 30px;
        }

        .feature {
            color: #aaa;
            font-size: 15px;
        }

        .feature-icon {
            font-size: 28px;
            display: block;
            margin-bottom: 8px;
        }

        .danger {
            color: #c00000;
        }

        h1, h2, h3, h4, h5, h6,
        p, span, small {
            color: white;
        }

        @media (max-width: 600px) {
            .game-card {
                padding: 40px 20px;
            }

            .title {
                font-size: 38px;
            }

            .subtitle {
                font-size: 17px;
            }

            .zombie-icon {
                font-size: 65px;
            }
        }
HEAD   
    .score-btn {
        display: inline-block;
        width: 100%;
        max-width: 350px;
        padding: 15px 30px;
        margin-top: 12px;
        background: #333;
        color: white;
        border: 1px solid #555;
        border-radius: 12px;
        font-size: 18px;
        font-weight: bold;
        text-decoration: none;
        transition: 0.2s;
    }

    .score-btn:hover {
        background: #555;
        color: white;
        transform: translateY(-3px);
    }


    </style>
</head>

<body>

<div class="background"></div>

<div class="container-game">

    <div class="game-card">

        <div class="zombie-icon">
            🧟
        </div>

        <h1 class="title">
            Zombie <span>Survival</span>
        </h1>

        <p class="subtitle">
            The apocalypse has begun.
            How long can you survive?
        </p>

        <div class="warning">
            ⚠️ <strong>WARNING:</strong>
            Food, water, ammunition and health are limited.
            Every decision could be your last.
        </div>

        <a href="{{ route('game.setup') }}" class="start-btn">
            ☠️ Start Survival
        </a>
<<<<<<< HEAD
        <a href="{{ route('best-score') }}" class="score-btn"> 🏆 See Best Score </a>
=======
>>>>>>> f424b5657147bfccd703f946e3c5cfd255ba3052

        <div class="features">

            <div class="row">

                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="feature">
                        <span class="feature-icon">🧭</span>
                        Explore Dangerous Areas
                    </div>
                </div>

                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="feature">
                        <span class="feature-icon">⚔️</span>
                        Fight Zombies & Survivors
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature">
                        <span class="feature-icon">🏆</span>
                        Survive 30 Days
                    </div>
                </div>

            </div>

        </div>

        <p class="mt-4 mb-0" style="color:#666 !important;">
            <small>
                Your choices determine your fate.
            </small>
        </p>

    </div>

</div>

</body>
</html>