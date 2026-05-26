<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NCCC Mall | Customer Portal</title>
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-light: #F8FAFC;
            --text-dark: #0F172A;
            --primary: #4F46E5;
            --secondary: #06B6D4;
            --accent: #F43F5E;
            --card-bg: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 5%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }

        .brand {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white !important;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary) !important;
            padding: 8px 24px;
            border-radius: 50px;
            font-weight: 600;
        }

        /* Hero Section */
        .hero {
            padding: 10rem 5% 6rem;
            min-height: 90vh;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: radial-gradient(circle at top right, rgba(6, 182, 212, 0.1), transparent 50%),
                        radial-gradient(circle at bottom left, rgba(79, 70, 229, 0.05), transparent 40%);
        }

        .hero-content {
            max-width: 600px;
        }

        .hero h1 {
            font-size: 4.5rem;
            line-height: 1.1;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }

        .hero h1 span {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.2rem;
            color: #64748B;
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .hero-image {
            width: 45%;
            position: relative;
        }

        .floating-card {
            background: white;
            padding: 1.5rem;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            position: absolute;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        /* Section Global */
        section {
            padding: 6rem 5%;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            font-weight: 700;
        }

        /* Grid Cards */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .card {
            background: var(--card-bg);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(0,0,0,0.02);
            position: relative;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(79, 70, 229, 0.1);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        .card h3 {
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
        }

        .card p {
            color: #64748B;
            line-height: 1.5;
        }

        /* Innovative Shop Cards */
        .shop-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(0,0,0,0.02);
            position: relative;
            cursor: pointer;
        }

        .shop-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
        }

        .shop-image-placeholder {
            height: 160px;
            background: linear-gradient(135deg, var(--bg-light), #E2E8F0);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .shop-image-placeholder::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.2), transparent);
        }
        
        .shop-card:nth-child(1n) .shop-image-placeholder { background: linear-gradient(135deg, #38BDF8, #0284C7); }
        .shop-card:nth-child(2n) .shop-image-placeholder { background: linear-gradient(135deg, #F472B6, #DB2777); }
        .shop-card:nth-child(3n) .shop-image-placeholder { background: linear-gradient(135deg, #A78BFA, #7C3AED); }
        .shop-card:nth-child(4n) .shop-image-placeholder { background: linear-gradient(135deg, #34D399, #059669); }
        .shop-card:nth-child(5n) .shop-image-placeholder { background: linear-gradient(135deg, #FBBF24, #D97706); }

        .shop-content {
            padding: 2rem;
            position: relative;
        }

        .shop-category {
            position: absolute;
            top: -15px;
            right: 20px;
            background: white;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--primary);
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        .shop-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        .shop-location {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: #F1F5F9;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            transition: background 0.3s;
        }

        .shop-card:hover .shop-location {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
        }

        /* Footer */
        footer {
            background: var(--text-dark);
            color: white;
            padding: 4rem 5%;
            text-align: center;
        }

        /* Innovative Reward Cards */
        .reward-card-container {
            perspective: 1000px;
        }

        .reward-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            border-radius: 30px;
            padding: 2.5rem;
            box-shadow: 0 15px 35px rgba(0,0,0,0.05), inset 0 0 0 1px rgba(255,255,255,0.5);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .reward-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.1), rgba(244, 63, 94, 0.05));
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: 0;
        }

        .reward-card:hover {
            transform: translateY(-15px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 30px 60px rgba(79, 70, 229, 0.15), inset 0 0 0 1px rgba(255,255,255,0.8);
        }

        .reward-card:hover::before {
            opacity: 1;
        }

        .reward-icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 24px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            margin-bottom: 2rem;
            transform: translateZ(30px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
            position: relative;
            z-index: 1;
        }

        .reward-card h3 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 1rem;
            transform: translateZ(20px);
            position: relative;
            z-index: 1;
            color: var(--text-dark);
        }

        .reward-card p {
            color: #64748B;
            line-height: 1.6;
            margin-bottom: 2rem;
            flex-grow: 1;
            transform: translateZ(15px);
            position: relative;
            z-index: 1;
        }

        .reward-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            transform: translateZ(25px);
            position: relative;
            z-index: 1;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        .points-badge {
            background: linear-gradient(135deg, #F59E0B, #EF4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 1.4rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .stock-badge {
            background: rgba(16, 185, 129, 0.1);
            color: #10B981;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .stock-badge.low-stock {
            background: rgba(244, 63, 94, 0.1);
            color: #F43F5E;
        }

        .redeem-btn {
            position: absolute;
            bottom: -60px;
            left: 50%;
            transform: translateX(-50%) translateZ(30px);
            background: var(--text-dark);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 2;
        }

        .reward-card:hover .redeem-btn {
            bottom: 25px;
            opacity: 1;
        }

        .reward-card:hover .reward-footer {
            opacity: 0.2;
            filter: blur(2px);
        }

        /* Abstract glowing blobs for section background */
        .rewards-section {
            position: relative;
            background: var(--bg-light);
            overflow: hidden;
            padding: 8rem 5%;
        }

        .rewards-blob-1 {
            position: absolute;
            top: -10%; left: -5%;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .rewards-blob-2 {
            position: absolute;
            bottom: -10%; right: -5%;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        /* Premium Glow Card */
        .mbr-card {
            width: 100%;
            aspect-ratio: 1.586 / 1; /* Standard credit card ratio */
            border-radius: 24px;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15), inset 0 0 0 1px rgba(255, 255, 255, 0.15);
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            color: white;
            text-align: left;
        }

        .mbr-card:hover {
            transform: translateY(-8px) rotateX(2deg) rotateY(2deg);
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.25), inset 0 0 0 1px rgba(255, 255, 255, 0.25);
        }

        /* Tier Card Designs */
        .card-bronze {
            background: radial-gradient(circle at 10% 20%, #7e5a3c 0%, #3e2614 90%);
            border-color: rgba(205, 127, 50, 0.3);
        }
        .card-silver {
            background: radial-gradient(circle at 10% 20%, #9eabb5 0%, #2f363c 90%);
            border-color: rgba(192, 192, 192, 0.3);
        }
        .card-gold {
            background: radial-gradient(circle at 10% 20%, #b89742 0%, #463410 90%);
            border-color: rgba(255, 215, 0, 0.3);
        }

        .card-glow-element {
            position: absolute;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            top: -50px;
            right: -50px;
            pointer-events: none;
        }

        .card-logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            font-size: 1.2rem;
            letter-spacing: 1px;
        }

        .card-logo i {
            font-size: 1.5rem;
        }

        .card-number {
            font-size: 1.4rem;
            font-family: monospace;
            letter-spacing: 2px;
            margin: 1.5rem 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        .card-holder {
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 600;
        }

        .card-meta {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            margin-top: 1rem;
        }

        .card-meta strong {
            color: #fff;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

    <!-- Flash Messages -->
    @if(session('success'))
        <div id="flash-success" style="position: fixed; top: 20px; right: 20px; z-index: 9999; background: #10B981; color: white; padding: 16px 24px; border-radius: 12px; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3); display: flex; align-items: center; gap: 12px; animation: slideIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;">
            <i class="ph-fill ph-check-circle" style="font-size: 1.5rem;"></i>
            <span style="font-weight: 600;">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div id="flash-error" style="position: fixed; top: 20px; right: 20px; z-index: 9999; background: #EF4444; color: white; padding: 16px 24px; border-radius: 12px; box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3); display: flex; align-items: center; gap: 12px; animation: slideIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;">
            <i class="ph-fill ph-warning-circle" style="font-size: 1.5rem;"></i>
            <span style="font-weight: 600;">{{ session('error') }}</span>
        </div>
    @endif

    <script>
        setTimeout(() => {
            const success = document.getElementById('flash-success');
            const error = document.getElementById('flash-error');
            if (success) success.style.opacity = '0';
            if (error) error.style.opacity = '0';
            setTimeout(() => {
                if (success) success.style.display = 'none';
                if (error) error.style.display = 'none';
            }, 500); // Wait for fade out
        }, 3000);
    </script>

    <style>
        @keyframes slideIn {
            0% { transform: translateX(100%); opacity: 0; }
            100% { transform: translateX(0); opacity: 1; }
        }
        #flash-success, #flash-error {
            transition: opacity 0.5s ease-out;
        }
    </style>

    <!-- Customer Navigation -->
    <nav class="navbar">
        <div class="brand">
            <i class="ph-fill ph-shopping-cart"></i>
            NCCC Mall
        </div>
        <div class="nav-links">
            <a href="#shops">Our Shops</a>
            <a href="#rewards">Rewards</a>
            <a href="#events">Upcoming Events</a>
            
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('user.dashboard') }}" class="btn-primary" style="margin-right: 1rem;">My Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-outline" style="background:transparent; cursor:pointer;">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-outline">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-primary">Become a Member</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            @auth
                <h1>Welcome Back, <span>{{ auth()->user()->name }}</span>!</h1>
                @php
                    $membership = auth()->user()->membership;
                @endphp
                
                @if($membership)
                    @if($membership->status === 'pending')
                        <p>Your membership application has been received and is currently waiting for admin review.</p>
                        <div style="background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.2); border-left-width: 4px; border-left-color: #F59E0B; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; color: #D97706; font-size: 0.95rem; font-weight: 500; display: flex; align-items: center; gap: 10px;">
                            <i class="ph-fill ph-clock" style="font-size: 1.25rem;"></i>
                            <span>Application ({{ strtoupper($membership->payment_method) }}) is pending admin approval.</span>
                        </div>
                    @elseif($membership->status === 'active')
                        <p>Enjoy your premium benefits! You are currently on the <strong>{{ $membership->tier }} Tier</strong>. Start shopping to earn more points and claim exclusive rewards.</p>
                        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                            <a href="#rewards" class="btn-primary" style="padding: 14px 32px; font-size: 1.1rem;">
                                View Rewards Catalog <i class="ph-bold ph-arrow-right"></i>
                            </a>
                        </div>
                    @elseif($membership->status === 'rejected')
                        <p>Your membership application has been rejected.</p>
                        <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-left-width: 4px; border-left-color: #EF4444; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; color: #DC2626; font-size: 0.95rem; font-weight: 500; display: flex; align-items: center; gap: 10px;">
                            <i class="ph-fill ph-warning-circle" style="font-size: 1.25rem;"></i>
                            <span>Application rejected. Please contact an admin.</span>
                        </div>
                    @elseif($membership->status === 'expired')
                        <p>Your membership has expired. Renew now to continue receiving discount points and rewards.</p>
                        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                            <a href="{{ route('membership.apply') }}" class="btn-primary" style="padding: 14px 32px; font-size: 1.1rem; background: linear-gradient(135deg, #EF4444, #F43F5E);">
                                Re-Apply for Membership <i class="ph-bold ph-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                @else
                    <p>You don't have an active membership yet. Unlock exclusive discounts, earn loyalty points, and claim premium rewards at NCCC Mall.</p>
                    <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                        <a href="{{ route('membership.apply') }}" class="btn-primary" style="padding: 14px 32px; font-size: 1.1rem;">
                            Apply for Membership (₱500) <i class="ph-bold ph-plus"></i>
                        </a>
                        <a href="#rewards" class="btn-outline" style="padding: 12px 30px; text-decoration: none; display: inline-flex; align-items: center; border-radius: 50px;">
                            View Rewards
                        </a>
                    </div>
                @endif
            @else
                <h1>Elevate Your <span>Shopping</span> Experience.</h1>
                <p>Join the NCCC Mall membership program. Earn points on every purchase, unlock exclusive rewards, and discover premium brands all in one place.</p>
                <div style="display: flex; gap: 1rem;">
                    <a href="#rewards" class="btn-primary" style="padding: 14px 32px; font-size: 1.1rem;">
                        View Rewards <i class="ph-bold ph-arrow-right"></i>
                    </a>
                </div>
            @endauth
        </div>
        
        <div class="hero-image">
            @auth
                @if($membership)
                    @php
                        $tierClass = 'card-bronze';
                        if (strtolower($membership->tier) === 'silver') $tierClass = 'card-silver';
                        if (strtolower($membership->tier) === 'gold') $tierClass = 'card-gold';
                    @endphp
                    <div class="mbr-card {{ $tierClass }}">
                        <div class="card-glow-element"></div>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="card-logo">
                                <i class="ph-fill ph-shopping-cart"></i> NCCC MALL
                            </div>
                            
                            @if($membership->status === 'pending')
                                <span style="background: rgba(245, 158, 11, 0.2); color: #F59E0B; border: 1px solid rgba(245, 158, 11, 0.4); font-size: 0.75rem; font-weight: 700; padding: 4px 10px; border-radius: 8px;">PENDING APPROVAL</span>
                            @elseif($membership->status === 'rejected')
                                <span style="background: rgba(239, 68, 68, 0.2); color: #EF4444; border: 1px solid rgba(239, 68, 68, 0.4); font-size: 0.75rem; font-weight: 700; padding: 4px 10px; border-radius: 8px;">REJECTED</span>
                            @elseif($membership->status === 'expired')
                                <span style="background: rgba(239, 68, 68, 0.2); color: #EF4444; border: 1px solid rgba(239, 68, 68, 0.4); font-size: 0.75rem; font-weight: 700; padding: 4px 10px; border-radius: 8px;">EXPIRED</span>
                            @else
                                <span style="background: rgba(16, 185, 129, 0.2); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.4); font-size: 0.75rem; font-weight: 700; padding: 4px 10px; border-radius: 8px;">ACTIVE</span>
                            @endif
                        </div>

                        <div>
                            <div class="card-number">
                                #MBR-{{ str_pad($membership->id, 5, '0', STR_PAD_LEFT) }}
                            </div>
                            <div class="card-holder">
                                {{ auth()->user()->name }}
                            </div>
                        </div>

                        <div class="card-meta">
                            <div>
                                <div>TIER</div>
                                <strong>{{ $membership->tier }}</strong>
                            </div>
                            <div>
                                <div>AVAILABLE POINTS</div>
                                <strong>{{ number_format($membership->points) }} PTS</strong>
                            </div>
                            <div>
                                <div>EXPIRY</div>
                                <strong>{{ $membership->expires_at ? $membership->expires_at->format('m / y') : 'N/A' }}</strong>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="mbr-card card-bronze" style="opacity: 0.9;">
                        <div class="card-glow-element"></div>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div class="card-logo">
                                <i class="ph-fill ph-shopping-cart"></i> NCCC MALL
                            </div>
                            <span style="background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.7); font-size: 0.75rem; font-weight: 700; padding: 4px 10px; border-radius: 8px;">INACTIVE</span>
                        </div>

                        <div>
                            <div class="card-number" style="color: rgba(255,255,255,0.5); font-size: 1.1rem; letter-spacing: 1px;">
                                MEMBERSHIP AVAILABLE
                            </div>
                            <div class="card-holder">
                                {{ auth()->user()->name }}
                            </div>
                        </div>

                        <div class="card-meta">
                            <div>
                                <div>TIER</div>
                                <strong>Bronze</strong>
                            </div>
                            <div>
                                <div>POINTS</div>
                                <strong>0 PTS</strong>
                            </div>
                            <div>
                                <div>ANNUAL FEE</div>
                                <strong>₱500</strong>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div style="width: 100%; height: 400px; background: linear-gradient(135deg, #E0E7FF, #CFFAFE); border-radius: 40px; position: relative;">
                    
                    <div class="floating-card" style="top: 10%; left: -15%;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #F59E0B, #EF4444); border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                                <i class="ph-fill ph-crown"></i>
                            </div>
                            <div>
                                <p style="margin:0; font-size: 0.9rem; font-weight: 600; color: #0F172A;">Gold Tier Unlocked</p>
                                <p style="margin:0; font-size: 0.8rem; color: #64748B;">+5,000 Points</p>
                            </div>
                        </div>
                    </div>

                    <div class="floating-card" style="bottom: 15%; right: -10%; animation-delay: 3s;">
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div style="width: 50px; height: 50px; background: #10B981; border-radius: 12px; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                                <i class="ph-bold ph-check"></i>
                            </div>
                            <div>
                                <p style="margin:0; font-size: 0.9rem; font-weight: 600; color: #0F172A;">Purchase Verified</p>
                                <p style="margin:0; font-size: 0.8rem; color: #64748B;">at NCCC Supermarket</p>
                            </div>
                        </div>
                    </div>

                </div>
            @endauth
        </div>
    </section>

    <!-- Shops Section -->
    <section id="shops" style="background: linear-gradient(to bottom, #FFFFFF, var(--bg-light)); position: relative; overflow: hidden; padding-bottom: 8rem;">
        <!-- Decorative elements -->
        <div style="position: absolute; top: 10%; right: -5%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(16, 185, 129, 0.05) 0%, transparent 70%); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: 10%; left: -5%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(244, 63, 94, 0.05) 0%, transparent 70%); border-radius: 50%;"></div>

        <div style="text-align: center; margin-bottom: 4rem; position: relative; z-index: 2;">
            <span style="color: var(--secondary); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 0.9rem; display: block; margin-bottom: 10px;">Discover Brands</span>
            <h2 style="font-size: 3.5rem; font-weight: 800; color: var(--text-dark);">Explore Our Shops</h2>
        </div>

        <div class="grid" style="position: relative; z-index: 2; gap: 2.5rem;">
            @forelse($shops as $shop)
                <a href="{{ route('shops.public.show', $shop) }}" class="shop-link" style="text-decoration: none; color: inherit; display: block;">
                    <div class="shop-card">
                        <div class="shop-image-placeholder" style="background: url('{{ $shop->image }}') center/cover no-repeat; height: 200px;">
                            @if(!$shop->image)
                                <i class="ph-fill ph-storefront"></i>
                            @endif
                        </div>
                        <div class="shop-content">
                            <div class="shop-category">{{ $shop->category ?? 'General' }}</div>
                            <h3>{{ $shop->name }}</h3>
                            <div class="shop-location">
                                <i class="ph-fill ph-map-pin"></i> {{ $shop->location ?? 'Level 1' }}
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div style="grid-column: 1 / -1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 5rem 2rem; background: rgba(255,255,255,0.8); backdrop-filter: blur(20px); border-radius: 40px; border: 1px dashed rgba(0,0,0,0.1); box-shadow: 0 20px 40px rgba(0,0,0,0.02); text-align: center;">
                    <div style="width: 100px; height: 100px; background: #F1F5F9; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #94A3B8; margin-bottom: 1.5rem;">
                        <i class="ph-fill ph-storefront"></i>
                    </div>
                    <h3 style="font-size: 2rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1rem;">Exciting Brands Arriving Soon</h3>
                    <p style="color: #64748B; font-size: 1.1rem; max-width: 400px;">We are currently curating the best retail experiences for you. Stay tuned!</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Rewards Section -->
    <section id="rewards" class="rewards-section">
        <div class="rewards-blob-1"></div>
        <div class="rewards-blob-2"></div>
        
        <div style="text-align: center; margin-bottom: 4rem; position: relative; z-index: 2;">
            <span style="color: var(--primary); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 0.9rem; display: block; margin-bottom: 10px;">Unlock Experiences</span>
            <h2 style="font-size: 3.5rem; font-weight: 800; color: var(--text-dark);">Premium Rewards Catalog</h2>
        </div>

        <div class="grid" style="position: relative; z-index: 2; gap: 3rem;">
            @php
                $icons = ['ph-coffee', 'ph-airplane-tilt', 'ph-fork-knife', 'ph-ticket'];
                $iconIndex = 0;
            @endphp
            @forelse($rewards as $reward)
                <div class="reward-card-container">
                    <div class="reward-card">
                        <div class="reward-icon-wrapper">
                            <i class="ph-fill {{ $icons[$iconIndex % count($icons)] }}"></i>
                            @php $iconIndex++; @endphp
                        </div>
                        <h3>{{ $reward->name }}</h3>
                        <p>{{ Str::limit($reward->description ?? 'Redeem this exclusive reward using your mall points.', 100) }}</p>
                        
                        <div class="reward-footer">
                            <span class="points-badge">
                                <i class="ph-fill ph-coin"></i> {{ number_format($reward->points_required) }}
                            </span>
                            <span class="stock-badge {{ $reward->stock < 10 ? 'low-stock' : '' }}">
                                @if($reward->stock < 10)
                                    <i class="ph-fill ph-fire"></i> Only {{ $reward->stock }} left!
                                @else
                                    <i class="ph-bold ph-package"></i> {{ $reward->stock }} Available
                                @endif
                            </span>
                        </div>
                        
                        <form action="{{ route('rewards.claim', $reward->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            <button type="submit" class="redeem-btn" style="border: none; cursor: pointer;">
                                Claim Reward <i class="ph-bold ph-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <!-- Fallback Empty State -->
                <div style="grid-column: 1 / -1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 5rem 2rem; background: rgba(255,255,255,0.6); backdrop-filter: blur(20px); border-radius: 40px; border: 1px solid rgba(255,255,255,0.8); box-shadow: 0 30px 60px rgba(0,0,0,0.05); position: relative; overflow: hidden;">
                    <div style="position: absolute; top: -50%; left: -10%; width: 400px; height: 400px; background: rgba(79, 70, 229, 0.15); filter: blur(80px); border-radius: 50%; animation: pulse 6s infinite alternate;"></div>
                    <div style="position: absolute; bottom: -50%; right: -10%; width: 400px; height: 400px; background: rgba(244, 63, 94, 0.15); filter: blur(80px); border-radius: 50%; animation: pulse 8s infinite alternate-reverse;"></div>
                    
                    <div style="position: relative; z-index: 10; text-align: center;">
                        <div style="width: 120px; height: 120px; margin: 0 auto 2rem; position: relative; animation: floatIcon 4s ease-in-out infinite;">
                            <div style="position: absolute; inset: 0; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 30px; transform: rotate(45deg); opacity: 0.15;"></div>
                            <div style="position: absolute; inset: 0; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 30px; transform: rotate(60deg); opacity: 0.1;"></div>
                            <div style="position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; font-size: 4rem; color: var(--primary);">
                                <i class="ph-fill ph-sparkle"></i>
                            </div>
                        </div>
                        
                        <h3 style="font-size: 2.5rem; font-weight: 800; color: var(--text-dark); margin-bottom: 1rem; background: linear-gradient(135deg, var(--text-dark), var(--primary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Curating Magic...</h3>
                        <p style="font-size: 1.2rem; color: #64748B; max-width: 450px; margin: 0 auto 2.5rem; line-height: 1.7;">Our rewards catalog is undergoing a spectacular upgrade. We're handpicking premium experiences and items just for you.</p>
                        
                        <div style="display: flex; gap: 1rem; justify-content: center;">
                            <div style="padding: 12px 24px; background: white; border-radius: 50px; font-size: 1rem; font-weight: 600; color: var(--primary); box-shadow: 0 10px 25px rgba(79, 70, 229, 0.1); display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <i class="ph-bold ph-bell-ringing"></i> Get Notified
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    @keyframes pulse {
                        0% { transform: scale(1); opacity: 0.5; }
                        100% { transform: scale(1.5); opacity: 0.8; }
                    }
                    @keyframes floatIcon {
                        0%, 100% { transform: translateY(0); }
                        50% { transform: translateY(-20px); }
                    }
                </style>
            @endforelse
        </div>
    </section>

    <!-- Events Section -->
    <section id="events" class="rewards-section" style="background: linear-gradient(to bottom, var(--bg-light), #FFFFFF); border-top: 1px solid rgba(0,0,0,0.03);">
        <div class="rewards-blob-1" style="background: radial-gradient(circle, rgba(244, 63, 94, 0.06) 0%, transparent 70%);"></div>
        <div class="rewards-blob-2" style="background: radial-gradient(circle, rgba(79, 70, 229, 0.06) 0%, transparent 70%);"></div>
        
        <div style="text-align: center; margin-bottom: 4rem; position: relative; z-index: 2;">
            <span style="color: var(--accent); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 0.9rem; display: block; margin-bottom: 10px;">Experience the Extraordinary</span>
            <h2 style="font-size: 3.5rem; font-weight: 800; color: var(--text-dark);">Upcoming Mall Events</h2>
        </div>

        <div class="grid" style="position: relative; z-index: 2; gap: 3rem;">
            @forelse($events as $event)
                <div class="reward-card-container">
                    <div class="reward-card" style="background: rgba(255, 255, 255, 0.85); padding: 0; overflow: hidden;">

                        {{-- Banner image or icon header --}}
                        @if($event->image)
                            <div style="width: 100%; height: 180px; overflow: hidden; flex-shrink: 0; border-radius: 30px 30px 0 0;">
                                <img src="{{ $event->image }}" alt="{{ $event->title }}"
                                     style="width: 100%; height: 100%; object-fit: cover;"
                                     onerror="this.parentElement.style.display='none'; this.parentElement.nextElementSibling.style.display='flex';">
                            </div>
                            <div style="display: none; justify-content: center; align-items: center; padding-top: 2.5rem;">
                                <div class="reward-icon-wrapper" style="
                                    @if($event->type === 'car_show') background: linear-gradient(135deg, #38BDF8, #0284C7);
                                    @elseif($event->type === 'small_concert') background: linear-gradient(135deg, #A78BFA, #7C3AED);
                                    @elseif($event->type === 'art_gallery') background: linear-gradient(135deg, #F472B6, #DB2777);
                                    @else background: linear-gradient(135deg, #34D399, #059669); @endif">
                                    @if($event->type === 'car_show') <i class="ph-fill ph-car"></i>
                                    @elseif($event->type === 'small_concert') <i class="ph-fill ph-guitar"></i>
                                    @elseif($event->type === 'art_gallery') <i class="ph-fill ph-palette"></i>
                                    @else <i class="ph-fill ph-calendar-star"></i> @endif
                                </div>
                            </div>
                        @else
                            <div style="padding-top: 2.5rem; padding-left: 2.5rem;">
                                <div class="reward-icon-wrapper" style="
                                    @if($event->type === 'car_show') background: linear-gradient(135deg, #38BDF8, #0284C7);
                                    @elseif($event->type === 'small_concert') background: linear-gradient(135deg, #A78BFA, #7C3AED);
                                    @elseif($event->type === 'art_gallery') background: linear-gradient(135deg, #F472B6, #DB2777);
                                    @else background: linear-gradient(135deg, #34D399, #059669); @endif">
                                    @if($event->type === 'car_show') <i class="ph-fill ph-car"></i>
                                    @elseif($event->type === 'small_concert') <i class="ph-fill ph-guitar"></i>
                                    @elseif($event->type === 'art_gallery') <i class="ph-fill ph-palette"></i>
                                    @else <i class="ph-fill ph-calendar-star"></i> @endif
                                </div>
                            </div>
                        @endif

                        <div style="padding: 1.5rem 2.5rem 2.5rem;">
                            <h3>{{ $event->title }}</h3>
                            <p>{{ Str::limit($event->description ?? 'Join us for this exciting upcoming event at NCCC Mall!', 100) }}</p>

                            <div class="reward-footer">
                                <span class="points-badge" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); -webkit-background-clip: unset; -webkit-text-fill-color: white; color: white; padding: 4px 12px; border-radius: 50px; font-size: 0.9rem;">
                                    <i class="ph-bold ph-calendar-blank"></i> {{ $event->event_date->format('M d, Y') }}
                                </span>
                                <span class="stock-badge" style="
                                    @if($event->type === 'car_show') background: rgba(56, 189, 248, 0.1); color: #0284C7;
                                    @elseif($event->type === 'small_concert') background: rgba(167, 139, 250, 0.1); color: #7C3AED;
                                    @elseif($event->type === 'art_gallery') background: rgba(244, 114, 182, 0.1); color: #DB2777;
                                    @else background: rgba(52, 211, 153, 0.1); color: #059669; @endif">
                                    @if($event->type === 'car_show') Car Show
                                    @elseif($event->type === 'small_concert') Concert
                                    @elseif($event->type === 'art_gallery') Art Gallery
                                    @else Special Event @endif
                                </span>
                            </div>

                            <a href="{{ auth()->check() ? route('user.dashboard') : route('login') }}" class="redeem-btn" style="text-decoration: none;">
                                View Event details <i class="ph-bold ph-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Fallback Empty State -->
                <div style="grid-column: 1 / -1; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 5rem 2rem; background: rgba(255,255,255,0.6); backdrop-filter: blur(20px); border-radius: 40px; border: 1px solid rgba(255,255,255,0.8); box-shadow: 0 30px 60px rgba(0,0,0,0.05); position: relative; overflow: hidden; width: 100%;">
                    <div style="position: absolute; top: -50%; left: -10%; width: 400px; height: 400px; background: rgba(244, 63, 94, 0.08); filter: blur(80px); border-radius: 50%;"></div>
                    
                    <div style="position: relative; z-index: 10; text-align: center;">
                        <div style="width: 120px; height: 120px; margin: 0 auto 2rem; position: relative; display: flex; align-items: center; justify-content: center;">
                            <div style="position: absolute; inset: 0; background: linear-gradient(135deg, var(--accent), var(--primary)); border-radius: 30px; transform: rotate(45deg); opacity: 0.15;"></div>
                            <div style="font-size: 4rem; color: var(--accent);">
                                <i class="ph-fill ph-calendar-blank"></i>
                            </div>
                        </div>
                        
                        <h3 style="font-size: 2.5rem; font-weight: 800; color: var(--text-dark); margin-bottom: 1rem; background: linear-gradient(135deg, var(--text-dark), var(--accent)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Stay Tuned...</h3>
                        <p style="font-size: 1.2rem; color: #64748B; max-width: 450px; margin: 0 auto; line-height: 1.7;">We are scheduling breathtaking concerts, vibrant car shows, and classic art exhibitions. Join our membership to be first to know!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Call to Action -->
    @guest
    <section style="background: linear-gradient(135deg, #1E1B4B, #312E81); color: white; text-align: center; padding: 8rem 5%;">
        <h2 style="font-size: 3rem; margin-bottom: 1.5rem;">Ready to get rewarded?</h2>
        <p style="font-size: 1.2rem; color: #A5B4FC; margin-bottom: 2.5rem; max-width: 600px; margin-inline: auto;">Join thousands of shoppers earning points every day. Registration is free and instant.</p>
        
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn-primary" style="padding: 16px 40px; font-size: 1.2rem; background: linear-gradient(135deg, #F43F5E, #FB923C);">
                Create Free Account
            </a>
        @else
            <a href="{{ route('login') }}" class="btn-primary" style="padding: 16px 40px; font-size: 1.2rem; background: linear-gradient(135deg, #F43F5E, #FB923C);">
                Login to Account
            </a>
        @endif
    </section>
    @endguest

    <footer>
        <div style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1rem;">
            <i class="ph-fill ph-shopping-cart"></i> NCCC Mall
        </div>
        <p style="color: #94A3B8;">&copy; {{ date('Y') }} NCCC Mall Membership System. All rights reserved.</p>
    </footer>

</body>
</html>
