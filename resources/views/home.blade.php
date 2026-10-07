<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zombie Survival</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts for cinematic visual hierarchy -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #070708;
            --accent-red: #d32f2f;
            --accent-red-glow: rgba(211, 47, 47, 0.4);
            --card-bg: rgba(18, 18, 22, 0.85);
            --border-color: rgba(255, 255, 255, 0.08);
        }

        body {
            background-color: var(--bg-dark);
            color: #f1f1f1;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow-x: hidden;
            position: relative;
        }

        /* Dynamic Background Layer */
        .background {
            position: fixed;
            inset: 0;
            background: 
                radial-gradient(circle at 50% 20%, rgba(138, 3, 3, 0.25) 0%, transparent 60%),
                radial-gradient(circle at 80% 80%, rgba(50, 0, 0, 0.15) 0%, transparent 50%),
                #070708;
            z-index: -2;
        }

        /* Ambient Noise Overlay */
        .bg-overlay {
            position: fixed;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 0);
            background-size: 24px 24px;
            z-index: -1;
            pointer-events: none;
        }

        .container-game {
            width: 100%;
            max-width: 820px;
            padding: 24px 16px;
        }

        /* Glassmorphism Card Container */
        .game-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 28px;
            padding: 56px 40px;
            text-align: center;
            box-shadow: 
                0 20px 50px rgba(0, 0, 0, 0.6),
                0 0 80px rgba(180, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Icon Animation */
        .zombie-icon {
            font-size: 80px;
            line-height: 1;
            margin-bottom: 20px;
            display: inline-block;
            filter: drop-shadow(0 0 15px rgba(255, 0, 0, 0.3));
            animation: pulseGlow 3s infinite ease-in-out;
        }

        @keyframes pulseGlow {
            0%, 100% { transform: scale(1); filter: drop-shadow(0 0 15px rgba(255, 0, 0, 0.3)); }
            50% { transform: scale(1.05); filter: drop-shadow(0 0 25px rgba(255, 0, 0, 0.6)); }
        }

        .title {
            font-size: 52px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 12px;
            color: #ffffff;
        }

        .title span {
            color: #ff3b3b;
            text-shadow: 0 0 20px rgba(255, 59, 59, 0.5);
        }

        .subtitle {
            color: #a0a0ab;
            font-size: 18px;
            font-weight: 400;
            line-height: 1.5;
            margin-bottom: 32px;
        }

        /* Warning Box */
        .warning {
            background: rgba(38, 12, 12, 0.6);
            border: 1px solid rgba(211, 47, 47, 0.3);
            border-radius: 16px;
            padding: 16px 20px;
            margin-bottom: 36px;
            color: #d1d1d6;
            font-size: 15px;
            backdrop-filter: blur(4px);
        }

        .warning strong {
            color: #ff4d4d;
            letter-spacing: 0.5px;
        }

        /* Action Buttons */
        .btn-group-custom {
            display: flex;
            flex-direction: column;
            gap: 14px;
            align-items: center;
            width: 100%;
        }

        .start-btn, .score-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 380px;
            padding: 16px 28px;
            border-radius: 14px;
            font-size: 18px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .start-btn {
            background: linear-gradient(135deg, #e50914 0%, #b20710 100%);
            color: #ffffff;
            border: none;
            box-shadow: 0 8px 24px var(--accent-red-glow);
        }

        .start-btn:hover {
            background: linear-gradient(135deg, #f40915 0%, #c40712 100%);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(229, 9, 20, 0.5);
        }

        .score-btn {
            background: rgba(255, 255, 255, 0.05);
            color: #d1d1d6;
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .score-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        /* Features Grid */
        .features {
            margin-top: 44px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 32px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.04);
            border-radius: 16px;
            padding: 20px 12px;
            height: 100%;
            transition: background 0.2s ease;
        }

        .feature-card:hover {
            background: rgba(255, 255, 255, 0.04);
        }

        .feature-text {
            color: #8e8e93;
            font-size: 14px;
            font-weight: 600;
            margin: 0;
        }

        .feature-icon {
            font-size: 30px;
            display: block;
            margin-bottom: 10px;
        }

        .footer-note {
            color: #636366;
            font-size: 13px;
            margin-top: 32px;
            margin-bottom: 0;
        }

        /* Mobile Adaptations */
        @media (max-width: 576px) {
            .game-card {
                padding: 36px 20px;
                border-radius: 20px;
            }

            .title {
                font-size: 36px;
            }

            .subtitle {
                font-size: 16px;
            }

            .zombie-icon {
                font-size: 64px;
            }

            .start-btn, .score-btn {
                font-size: 16px;
                padding: 14px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="background"></div>
    <div class="bg-overlay"></div>

    <div class="container-game">
        <div class="game-card">

            <div class="zombie-icon">🧟</div>

            <h1 class="title">Zombie <span>Survival</span></h1>

            <p class="subtitle">
                The apocalypse has begun.<br class="d-none d-sm-inline"> How long can you stay alive?
            </p>

            <div class="warning">
                ⚠️ <strong>WARNING:</strong> Resources are strictly scarce. Food, water, ammo, and health deplete quickly—every action carries risk.
            </div>

            <div class="btn-group-custom">
                <a href="{{ route('game.setup') }}" class="start-btn">
                    ☠️ Start Survival
                </a>
                <a href="{{ route('best-score') }}" class="score-btn">
                    🏆 View High Scores
                </a>
            </div>

            <div class="features">
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <div class="feature-card">
                            <span class="feature-icon">🧭</span>
                            <p class="feature-text">Scavenge Regions</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="feature-card">
                            <span class="feature-icon">⚔️</span>
                            <p class="feature-text">Combat Threats</p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="feature-card">
                            <span class="feature-icon">🏆</span>
                            <p class="feature-text">Survive 30 Days</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="footer-note">
                Your tactical choices decide your fate.
            </p>

        </div>
    </div>

</body>
</html>