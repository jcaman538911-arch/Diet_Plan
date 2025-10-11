<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Diet Plan Studio')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f5fbf5;
            --primary: #4f8a3e;
            --primary-dark: #3b6a30;
            --text: #143018;
            --muted: #5c6f59;
            --card: #ffffff;
            --shadow: rgba(36, 63, 31, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
        }

        header {
            position: sticky;
            top: 0;
            z-index: 10;
            backdrop-filter: blur(12px);
            background: rgba(245, 251, 245, 0.82);
            border-bottom: 1px solid rgba(79, 138, 62, 0.08);
        }

        .nav-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 18px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .brand {
            font-weight: 700;
            font-size: 22px;
            color: var(--primary);
            text-decoration: none;
        }

        nav {
            display: flex;
            gap: 18px;
        }

        nav a {
            text-decoration: none;
            font-weight: 500;
            color: var(--muted);
            transition: color 0.2s;
        }

        nav a:hover {
            color: var(--primary);
        }

        .btn-primary {
            padding: 10px 24px;
            background: var(--primary);
            color: #fff;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 12px 24px rgba(79, 138, 62, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 32px rgba(79, 138, 62, 0.24);
        }

        main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 60px 28px 80px;
        }

        footer {
            padding: 32px 24px;
            background: rgba(79, 138, 62, 0.08);
            color: var(--muted);
            text-align: center;
            font-size: 14px;
        }

        .hero {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
            align-items: center;
        }

        .hero-copy h1 {
            font-size: clamp(2.4rem, 4vw, 3.4rem);
            margin-bottom: 18px;
            font-weight: 700;
        }

        .hero-copy p {
            max-width: 520px;
            color: var(--muted);
            margin-bottom: 24px;
        }

        .hero-img {
            position: relative;
            min-height: 320px;
        }

        .hero-img::before,
        .hero-img::after {
            content: '';
            position: absolute;
            border-radius: 28px;
            box-shadow: 0 32px 48px rgba(36, 63, 31, 0.12);
        }

        .hero-img::before {
            inset: 0;
            background: url('https://images.unsplash.com/photo-1543352634-873f17a7a088?auto=format&fit=crop&w=900&q=80') center/cover;
        }

        .hero-img::after {
            width: 160px;
            height: 160px;
            background: rgba(79, 138, 62, 0.18);
            top: -40px;
            right: -20px;
            filter: blur(0.4px);
        }

        .section-title {
            font-size: 30px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .section-description {
            color: var(--muted);
            margin-bottom: 34px;
            max-width: 640px;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 24px;
        }

        .feature-card {
            background: var(--card);
            padding: 24px;
            border-radius: 20px;
            box-shadow: 0 18px 38px var(--shadow);
            border: 1px solid rgba(79, 138, 62, 0.12);
        }

        .feature-card h3 {
            font-size: 18px;
            margin-bottom: 12px;
        }

        .feature-card p {
            font-size: 14px;
            color: var(--muted);
        }

        @media (max-width: 720px) {
            nav {
                display: none;
            }

            header {
                position: static;
            }

            main {
                padding-top: 40px;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <header>
        <div class="nav-container">
            <a href="{{ route('landing.home') }}" class="brand">Diet Plan Studio</a>
            <nav>
                <a href="{{ route('landing.planner') }}">Planner</a>
                <a href="{{ route('landing.result') }}">Sample Plan</a>
                <a href="{{ route('landing.progress') }}">Progress</a>
                <a href="{{ route('landing.tips') }}">Tips</a>
                <a href="{{ route('landing.contact') }}">Contact</a>
            </nav>
            <a href="{{ route('login') }}" class="btn-primary">Sign In</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        © {{ date('Y') }} Diet Plan Studio. Eat smart, live strong.
    </footer>
</body>
</html>
