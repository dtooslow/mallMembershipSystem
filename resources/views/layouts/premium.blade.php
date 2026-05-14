<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'NCCC Mall') }} | @yield('title', 'Dashboard')</title>
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-dark: #0B0F19;
            --bg-card: rgba(30, 41, 59, 0.4);
            --bg-card-hover: rgba(30, 41, 59, 0.7);
            --primary: #38BDF8;
            --secondary: #818CF8;
            --accent: #F472B6;
            --text-main: #F8FAFC;
            --text-muted: #94A3B8;
            --border: rgba(255, 255, 255, 0.08);
            --glass-blur: blur(16px);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated Background Gradient */
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 50% 50%, rgba(56, 189, 248, 0.05) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(129, 140, 248, 0.05) 0%, transparent 40%);
            z-index: -1;
            animation: pulse-bg 15s infinite alternate ease-in-out;
        }

        @keyframes pulse-bg {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            background: rgba(11, 15, 25, 0.7);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 2rem;
            z-index: 100;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand i {
            font-size: 2rem;
            -webkit-text-fill-color: var(--primary);
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 12px 16px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .nav-link:hover, .nav-link.active {
            background: var(--bg-card);
            color: var(--text-main);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .nav-link i {
            font-size: 1.25rem;
            transition: transform 0.3s ease;
        }

        .nav-link:hover i {
            transform: scale(1.1) translateX(2px);
            color: var(--primary);
        }

        /* Main Content */
        .main-wrapper {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 2rem 3rem;
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Premium Buttons */
        .btn-glow {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            padding: 10px 24px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .btn-glow span, .btn-glow i {
            position: relative;
            z-index: 2;
        }

        .btn-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(56, 189, 248, 0.3);
        }

        .btn-glow:hover::before {
            opacity: 1;
        }

        /* Glass Cards */
        .glass-card {
            background: var(--bg-card);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            border-color: rgba(255,255,255,0.15);
            background: var(--bg-card-hover);
            transform: translateY(-2px);
        }

        /* Tables */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 1rem 1.5rem;
            color: var(--text-muted);
            font-weight: 500;
            border-bottom: 1px solid var(--border);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            color: var(--text-main);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tbody tr {
            transition: all 0.2s;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .form-control {
            width: 100%;
            background: rgba(0,0,0,0.2);
            border: 1px solid var(--border);
            color: white;
            padding: 12px 16px;
            border-radius: 12px;
            outline: none;
            transition: all 0.3s;
            font-family: inherit;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
        }

        /* Badges */
        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-bronze { background: rgba(205, 127, 50, 0.1); color: #CD7F32; border: 1px solid rgba(205, 127, 50, 0.3); }
        .badge-silver { background: rgba(192, 192, 192, 0.1); color: #C0C0C0; border: 1px solid rgba(192, 192, 192, 0.3); }
        .badge-gold { background: rgba(255, 215, 0, 0.1); color: #FFD700; border: 1px solid rgba(255, 215, 0, 0.3); }

        /* Action Buttons in Table */
        .action-btns {
            display: flex;
            gap: 8px;
        }
        
        .btn-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,0.05);
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .btn-icon:hover {
            color: white;
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.2);
            transform: scale(1.05);
        }

        .btn-icon.delete:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #EF4444;
            border-color: rgba(239, 68, 68, 0.3);
        }

        /* Toast Alert */
        .toast {
            position: fixed;
            bottom: 2rem; right: 2rem;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34D399;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            backdrop-filter: var(--glass-blur);
            display: flex; align-items: center; gap: 12px;
            animation: slideIn 0.3s ease forwards;
            z-index: 1000;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    <nav class="sidebar">
        <div class="brand">
            <i class="ph-fill ph-shopping-cart"></i>
            NCCC Mall
        </div>

        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="ph ph-squares-four"></i> Dashboard
        </a>
        <a href="{{ route('shops.index') }}" class="nav-link {{ request()->routeIs('shops.*') ? 'active' : '' }}">
            <i class="ph ph-storefront"></i> Shops
        </a>
        <a href="{{ route('transactions.index') }}" class="nav-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
            <i class="ph ph-receipt"></i> Transactions
        </a>
        <a href="{{ route('memberships.index') }}" class="nav-link {{ request()->routeIs('memberships.*') ? 'active' : '' }}">
            <i class="ph ph-users-three"></i> Memberships
        </a>
        <a href="{{ route('rewards.index') }}" class="nav-link {{ request()->routeIs('rewards.*') ? 'active' : '' }}">
            <i class="ph ph-gift"></i> Rewards
        </a>

        <div style="margin-top: auto;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link" style="width: 100%; border: none; background: none; cursor: pointer; text-align: left;">
                    <i class="ph ph-sign-out"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-wrapper">
        <header>
            <h1 class="page-title">@yield('title')</h1>
            <div class="header-actions">
                @yield('actions')
            </div>
        </header>

        @if(session('success'))
            <div class="toast" id="toast">
                <i class="ph-fill ph-check-circle" style="font-size: 1.5rem;"></i>
                {{ session('success') }}
            </div>
            <script>
                setTimeout(() => {
                    document.getElementById('toast').style.opacity = '0';
                    setTimeout(() => document.getElementById('toast').remove(), 300);
                }, 3000);
            </script>
        @endif

        @yield('content')
    </main>

</body>
</html>
