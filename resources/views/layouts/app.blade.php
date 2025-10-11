<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Diet Plan System')</title>
    <style>
        :root {
            --color-background: #e8f4e6;
            --color-background-hero: linear-gradient(180deg, #f4fbf2 0%, #e5f2e1 100%);
            --color-sidebar: #ffffff;
            --color-border: #d2e3cd;
            --color-text: #2f3f2f;
            --color-muted: #6c806c;
            --color-accent: #4f8a3e;
            --color-accent-dark: #3c6c2f;
            --color-accent-soft: rgba(79, 138, 62, 0.12);
            --color-surface: #ffffff;
            --color-surface-alt: #f1f7ef;
            --color-shadow: rgba(73, 112, 63, 0.08);
            --color-danger: #dc3545;
            --color-danger-dark: #bf2535;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: var(--color-background-hero);
            color: var(--color-text);
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 90px;
            background-color: var(--color-sidebar);
            border-right: 1px solid var(--color-border);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 24px 0;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            box-shadow: 6px 0 20px rgba(56, 96, 49, 0.06);
        }

        .logo {
            width: 52px;
            height: 52px;
            margin-bottom: 42px;
            border-radius: 14px;
            background: var(--color-accent-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .nav-menu {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 28px;
            width: 100%;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--color-muted);
            font-size: 11px;
            padding: 12px 10px;
            transition: all 0.3s;
            position: relative;
            border-radius: 14px 0 0 14px;
            margin-left: 6px;
        }

        .nav-item:hover {
            color: var(--color-accent);
            background: rgba(79, 138, 62, 0.08);
        }

        .nav-item.active {
            color: var(--color-accent);
            background: rgba(79, 138, 62, 0.12);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: -6px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 36px;
            border-radius: 12px;
            background-color: var(--color-accent);
        }

        .nav-icon {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .logout-btn {
            margin-top: auto;
            background: none;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 90px;
            padding: 36px 40px;
            max-width: 1400px;
            display: flex;
            justify-content: center;
        }

        .content-wrapper {
            width: 100%;
            max-width: 1080px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        .header {
            margin-bottom: 28px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 10px;
        }

        .header p {
            color: var(--color-muted);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-primary {
            background: var(--color-accent);
            color: #fff;
            box-shadow: 0 6px 16px rgba(79, 138, 62, 0.25);
        }

        .btn-primary:hover {
            background: var(--color-accent-dark);
        }

        .btn-secondary {
            background: var(--color-surface-alt);
            color: var(--color-accent-dark);
            border: 1px solid rgba(79, 138, 62, 0.18);
        }

        .btn-secondary:hover {
            background: rgba(79, 138, 62, 0.18);
            color: var(--color-text);
        }

        .btn-danger {
            background-color: var(--color-danger);
            color: #fff;
        }

        .btn-danger:hover {
            background-color: var(--color-danger-dark);
        }

        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            border: 1px solid transparent;
        }

        .alert-success {
            background-color: rgba(79, 138, 62, 0.12);
            color: var(--color-accent-dark);
            border-color: rgba(79, 138, 62, 0.2);
        }

        .alert-error {
            background-color: rgba(220, 53, 69, 0.12);
            color: var(--color-danger-dark);
            border-color: rgba(220, 53, 69, 0.28);
        }

        /* Help Button */
        .help-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 54px;
            height: 54px;
            border-radius: 18px;
            background: var(--color-accent);
            color: white;
            border: none;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 12px 30px rgba(79, 138, 62, 0.22);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .help-btn:hover {
            background: var(--color-accent-dark);
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>
            
            <nav class="nav-menu">
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">🏠</span>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('recipes.index') }}" class="nav-item {{ request()->routeIs('recipes.*') ? 'active' : '' }}">
                    <span class="nav-icon">🍳</span>
                    <span>Recipes</span>
                </a>
                
                <a href="{{ route('meal-plans.index') }}" class="nav-item {{ request()->routeIs('meal-plans.*') ? 'active' : '' }}">
                    <span class="nav-icon">📋</span>
                    <span>Meal plans</span>
                </a>
                
                <a href="{{ route('help') }}" class="nav-item {{ request()->routeIs('help') ? 'active' : '' }}">
                    <span class="nav-icon">❓</span>
                    <span>Help</span>
                </a>
            </nav>

            <form action="{{ route('logout') }}" method="POST" class="logout-btn">
                @csrf
                <button type="submit" class="nav-item" style="background: none; border: none; cursor: pointer;">
                    <span class="nav-icon">🚪</span>
                    <span>Log out</span>
                </button>
            </form>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <!-- Help Button -->
        <button class="help-btn">?</button>
    </div>

    @yield('scripts')
</body>
</html>
