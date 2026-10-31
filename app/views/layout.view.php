<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Wisp MVC</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0a0c10;
            --card-bg: rgba(22, 28, 36, 0.45);
            --card-border: rgba(255, 255, 255, 0.08);
            --text-primary: #f3f4f6;
            --text-secondary: #9ca3af;
            --primary-gradient: linear-gradient(135deg, #a855f7 0%, #6366f1 100%);
            --accent-glow: rgba(99, 102, 241, 0.15);
            --success-color: #10b981;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
            position: relative;
        }

        /* Abstract Background Gradients */
        body::before {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.3) 0%, rgba(0,0,0,0) 70%);
            top: 10%;
            left: 10%;
            z-index: -1;
            filter: blur(50px);
        }

        body::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, rgba(0,0,0,0) 70%);
            bottom: 10%;
            right: 10%;
            z-index: -1;
            filter: blur(60px);
        }

        .container {
            width: 100%;
            max-width: 680px;
            padding: 2rem;
            z-index: 1;
        }

        .header {
            text-align: center;
            margin-bottom: 2.5rem;
            animation: fadeInDown 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .logo-text {
            font-family: 'Outfit', sans-serif;
            font-weight: 800;
            font-size: 2.5rem;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.03em;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            font-size: 1rem;
            color: var(--text-secondary);
            font-weight: 400;
        }

        /* Glassmorphic Card */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 2.5rem;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), 
                        inset 0 1px 0 rgba(255, 255, 255, 0.1);
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .footer-info {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.8rem;
            color: var(--text-secondary);
            animation: fadeIn 1s ease-in 0.5s both;
        }

        /* Animations */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo-text">Wisp MVC Plugin</div>
            <div class="subtitle">Micro-framework architecture with elegant MVC layout</div>
        </header>

        <main class="card">
            @yield('content')
        </main>

        <footer class="footer-info">
            Wisp Micro-Framework &copy; {{ date('Y') }} - Created with Premium Aesthetics
        </footer>
    </div>
</body>
</html>
