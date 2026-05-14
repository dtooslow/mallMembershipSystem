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

        /* Footer */
        footer {
            background: var(--text-dark);
            color: white;
            padding: 4rem 5%;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Customer Navigation -->
    <nav class="navbar">
        <div class="brand">
            <i class="ph-fill ph-shopping-cart"></i>
            NCCC Mall
        </div>
        <div class="nav-links">
            <a href="#shops">Our Shops</a>
            <a href="#rewards">Rewards</a>
            
            @if (Route::has('login'))
                @auth
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
            <h1>Elevate Your <span>Shopping</span> Experience.</h1>
            <p>Join the NCCC Mall membership program. Earn points on every purchase, unlock exclusive rewards, and discover premium brands all in one place.</p>
            <div style="display: flex; gap: 1rem;">
                <a href="#rewards" class="btn-primary" style="padding: 14px 32px; font-size: 1.1rem;">
                    View Rewards <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>
        </div>
        <div class="hero-image">
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
        </div>
    </section>

    <!-- Shops Section -->
    <section id="shops" style="background: white;">
        <h2 class="section-title">Explore Our Shops</h2>
        <div class="grid">
            @forelse($shops as $shop)
                <div class="card">
                    <div class="card-icon">
                        <i class="ph-fill ph-storefront"></i>
                    </div>
                    <h3>{{ $shop->name }}</h3>
                    <p style="margin-bottom: 1rem;">Category: <strong>{{ $shop->category ?? 'General' }}</strong></p>
                    <div style="display: inline-block; padding: 4px 12px; background: #F1F5F9; border-radius: 50px; font-size: 0.85rem; font-weight: 600;">
                        <i class="ph-fill ph-map-pin"></i> {{ $shop->location ?? 'Level 1' }}
                    </div>
                </div>
            @empty
                <p style="text-align: center; width: 100%; color: #64748B;">New shops are opening soon!</p>
            @endforelse
        </div>
    </section>

    <!-- Rewards Section -->
    <section id="rewards">
        <h2 class="section-title">Redeem Exciting Rewards</h2>
        <div class="grid">
            @forelse($rewards as $reward)
                <div class="card" style="border: 2px solid transparent; background: linear-gradient(white, white) padding-box, linear-gradient(135deg, var(--secondary), var(--primary)) border-box;">
                    <div class="card-icon" style="background: rgba(6, 182, 212, 0.1); color: var(--secondary);">
                        <i class="ph-fill ph-gift"></i>
                    </div>
                    <h3>{{ $reward->name }}</h3>
                    <p>{{ Str::limit($reward->description ?? 'Redeem this exclusive reward using your mall points.', 60) }}</p>
                    
                    <div style="margin-top: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1.2rem; font-weight: 800; color: var(--primary);">{{ number_format($reward->points_required) }} pts</span>
                        <span style="font-size: 0.8rem; color: #64748B; font-weight: 600;">{{ $reward->stock }} Left</span>
                    </div>
                </div>
            @empty
                <p style="text-align: center; width: 100%; color: #64748B;">Our rewards catalog is currently being updated. Check back soon!</p>
            @endforelse
        </div>
    </section>

    <!-- Call to Action -->
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

    <footer>
        <div style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1rem;">
            <i class="ph-fill ph-shopping-cart"></i> NCCC Mall
        </div>
        <p style="color: #94A3B8;">&copy; {{ date('Y') }} NCCC Mall Membership System. All rights reserved.</p>
    </footer>

</body>
</html>
