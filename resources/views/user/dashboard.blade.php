<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard | NCCC Mall</title>
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-dark: #0B0F19;
            --bg-card: rgba(30, 41, 59, 0.5);
            --bg-card-hover: rgba(30, 41, 59, 0.8);
            --primary: #38BDF8;
            --secondary: #818CF8;
            --accent: #F472B6;
            --success: #10B981;
            --warning: #F59E0B;
            --text-main: #F8FAFC;
            --text-muted: #94A3B8;
            --border: rgba(255, 255, 255, 0.08);
            --glass-blur: blur(20px);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        
        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            padding-bottom: 4rem;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle at 50% 50%, rgba(56, 189, 248, 0.08) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(129, 140, 248, 0.08) 0%, transparent 40%);
            z-index: -1;
            animation: pulse-bg 15s infinite alternate ease-in-out;
        }

        @keyframes pulse-bg { 0% { transform: scale(1); } 100% { transform: scale(1.1); } }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.2rem 5%;
            background: rgba(11, 15, 25, 0.7);
            backdrop-filter: var(--glass-blur);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand {
            display: flex; align-items: center; gap: 12px;
            font-size: 1.5rem; font-weight: 800; text-decoration: none;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        .brand i { font-size: 2rem; -webkit-text-fill-color: var(--primary); }

        .nav-actions { display: flex; align-items: center; gap: 1.5rem; }
        .nav-link { color: var(--text-main); text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 6px; transition: color 0.3s; }
        .nav-link:hover { color: var(--primary); }
        .btn-logout { background: none; border: none; color: var(--text-muted); cursor: pointer; font-weight: 600; font-size: 1rem; transition: color 0.3s; display: flex; align-items: center; gap: 6px; }
        .btn-logout:hover { color: var(--accent); }

        /* Main Container */
        .container { max-width: 1200px; margin: 3rem auto; padding: 0 5%; animation: fadeIn 0.8s ease forwards; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        .page-header { margin-bottom: 2.5rem; }
        .page-header h1 { font-size: 2.5rem; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 0.5rem; }
        .page-header p { color: var(--text-muted); font-size: 1.1rem; }

        /* Glass Cards */
        .glass-card {
            background: var(--bg-card);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }
        .glass-card:hover { border-color: rgba(255,255,255,0.15); transform: translateY(-3px); }
        
        .card-glow {
            position: absolute; top: -50px; right: -50px; width: 150px; height: 150px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.2) 0%, transparent 70%);
            border-radius: 50%; pointer-events: none;
        }

        /* Membership Status Details */
        .status-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
        .status-header h2 { font-size: 1.6rem; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .status-header h2 i { color: var(--primary); }

        .badge {
            padding: 6px 16px; border-radius: 50px; font-weight: 700; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .badge.active { background: rgba(16, 185, 129, 0.15); color: var(--success); border: 1px solid rgba(16, 185, 129, 0.3); }
        .badge.pending { background: rgba(245, 158, 11, 0.15); color: var(--warning); border: 1px solid rgba(245, 158, 11, 0.3); }
        .badge.expired { background: rgba(244, 114, 182, 0.15); color: var(--accent); border: 1px solid rgba(244, 114, 182, 0.3); }

        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem; }
        .stat-box { background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 16px; padding: 1.5rem; text-align: center; }
        .stat-label { color: var(--text-muted); font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem; }
        .stat-value { font-size: 2rem; font-weight: 800; color: white; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .stat-value.highlight { background: linear-gradient(135deg, var(--primary), var(--secondary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        /* History Grids */
        .history-section { margin-top: 3rem; }
        .history-title { font-size: 1.4rem; font-weight: 700; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; border-bottom: 1px solid var(--border); padding-bottom: 1rem; }
        
        .history-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem; }
        
        .history-card {
            background: rgba(255,255,255,0.02); border: 1px solid var(--border); border-radius: 16px; padding: 1.2rem;
            display: flex; gap: 1rem; align-items: center; transition: all 0.3s;
        }
        .history-card:hover { background: rgba(255,255,255,0.05); transform: translateY(-2px); }
        
        .history-icon {
            width: 54px; height: 54px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; flex-shrink: 0;
        }
        .history-icon.purchase { background: linear-gradient(135deg, rgba(56, 189, 248, 0.2), rgba(129, 140, 248, 0.2)); color: var(--primary); }
        .history-icon.reward { background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.2)); color: var(--success); }
        
        .history-info { flex: 1; min-width: 0; }
        .history-name { font-weight: 700; font-size: 1.05rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 4px; }
        .history-date { font-size: 0.8rem; color: var(--text-muted); }
        
        .history-meta { text-align: right; }
        .history-val { font-weight: 800; font-size: 1.1rem; }
        .history-points { font-size: 0.85rem; font-weight: 700; padding: 2px 8px; border-radius: 8px; display: inline-flex; align-items: center; gap: 4px; margin-top: 6px; }
        .history-points.earned { background: rgba(16, 185, 129, 0.15); color: var(--success); }
        .history-points.spent { background: rgba(244, 114, 182, 0.15); color: var(--accent); }

        .empty-state { text-align: center; padding: 3rem 1rem; background: rgba(255,255,255,0.02); border-radius: 16px; border: 1px dashed var(--border); }
        .empty-state i { font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem; opacity: 0.5; }
        .empty-state h3 { font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem; }
        .empty-state p { color: var(--text-muted); font-size: 0.95rem; max-width: 300px; margin: 0 auto; }

        /* Apply CTA */
        .apply-cta { text-align: center; padding: 4rem 2rem; }
        .apply-icon { width: 80px; height: 80px; background: linear-gradient(135deg, rgba(56, 189, 248, 0.1), rgba(129, 140, 248, 0.1)); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; color: var(--primary); margin: 0 auto 1.5rem; box-shadow: 0 0 40px rgba(56, 189, 248, 0.2); }
        .apply-cta h2 { font-size: 2rem; font-weight: 800; margin-bottom: 1rem; }
        .apply-cta p { color: var(--text-muted); font-size: 1.1rem; max-width: 400px; margin: 0 auto 2.5rem; line-height: 1.6; }
        .btn-apply { display: inline-flex; align-items: center; gap: 10px; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; padding: 16px 36px; border-radius: 16px; font-weight: 800; font-size: 1.1rem; text-decoration: none; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s; box-shadow: 0 10px 30px rgba(56, 189, 248, 0.3); }
        .btn-apply:hover { transform: translateY(-3px); box-shadow: 0 15px 40px rgba(56, 189, 248, 0.4); }

        /* Messages */
        .msg { padding: 1rem 1.5rem; border-radius: 16px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 12px; font-weight: 600; }
        .msg.success { background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); color: var(--success); }
        .msg.error { background: rgba(244, 114, 182, 0.1); border: 1px solid rgba(244, 114, 182, 0.2); color: var(--accent); }
        /* Notifications styling */
        .notification-card {
            background: rgba(255,255,255,0.02); border: 1px solid var(--border); border-radius: 16px; padding: 1.2rem;
            display: flex; gap: 1.2rem; align-items: flex-start; transition: all 0.3s;
            position: relative;
        }
        .notification-card:hover { background: rgba(255,255,255,0.04); transform: translateY(-2px); }
        .notification-card.unread { border-color: rgba(56, 189, 248, 0.25); background: rgba(56, 189, 248, 0.02); }
        
        .notification-icon {
            width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0;
            background: rgba(255, 255, 255, 0.05); color: var(--text-muted);
        }
        .notification-icon.unread {
            background: linear-gradient(135deg, rgba(56, 189, 248, 0.15), rgba(129, 140, 248, 0.15)); color: var(--primary);
        }

        .notification-content { flex: 1; min-width: 0; }
        .notification-title { font-weight: 700; font-size: 1.05rem; margin-bottom: 4px; display: flex; align-items: center; gap: 8px; }
        .notification-desc { color: var(--text-muted); font-size: 0.92rem; line-height: 1.5; margin-bottom: 8px; }
        .notification-time { font-size: 0.8rem; color: var(--text-muted); display: flex; align-items: center; gap: 4px; }
        
        .notification-actions { display: flex; gap: 8px; align-self: center; }
        .btn-noti-action {
            width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,0.05); color: var(--text-muted); border: 1px solid transparent; cursor: pointer; transition: all 0.2s;
        }
        .btn-noti-action:hover { color: white; background: rgba(255,255,255,0.1); transform: scale(1.05); }
        .btn-noti-action.delete:hover { background: rgba(239,68,68,0.1); color: #EF4444; }
    </style>
</head>
<body>

    @php $membership = auth()->user()->membership; @endphp
    <nav class="navbar">
        <a href="/" class="brand">
            <i class="ph-fill ph-shopping-cart"></i> NCCC Mall
        </a>
        <div class="nav-actions">
            <a href="/" class="nav-link"><i class="ph-bold ph-storefront"></i> Mall Site</a>
            @if($membership)
                @php
                    $unreadCount = $notifications->where('is_read', false)->count();
                @endphp
                <a href="#notifications" class="nav-link" style="position: relative; margin-right: 0.5rem;" title="View Notifications">
                    <i class="ph-bold ph-bell" style="font-size: 1.35rem;"></i>
                    @if($unreadCount > 0)
                        <span style="position: absolute; top: -6px; right: -6px; background: var(--accent); color: white; border-radius: 50%; width: 18px; height: 18px; font-size: 0.7rem; display: flex; align-items: center; justify-content: center; font-weight: 700; border: 2px solid var(--bg-dark);">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout"><i class="ph-bold ph-sign-out"></i> Logout</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1>Welcome, {{ auth()->user()->name }}!</h1>
            <p>Manage your membership, track points, and view your history.</p>
        </div>

        @if(session('success'))
            <div class="msg success"><i class="ph-fill ph-check-circle" style="font-size:1.5rem;"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="msg error"><i class="ph-fill ph-warning-circle" style="font-size:1.5rem;"></i> {{ session('error') }}</div>
        @endif
        @if(session('info'))
            <div class="msg info"><i class="ph-fill ph-info" style="font-size:1.5rem;"></i> {{ session('info') }}</div>
        @endif



        <div class="glass-card">
            <div class="card-glow"></div>

            @if(!$membership)
                <div class="apply-cta">
                    <div class="apply-icon"><i class="ph-fill ph-identification-card"></i></div>
                    <h2>Unlock NCCC Mall VIP</h2>
                    <p>Apply for a membership to earn loyalty points on every purchase and redeem exclusive rewards.</p>
                    <a href="{{ route('membership.apply') }}" class="btn-apply">
                        Apply Now (₱500) <i class="ph-bold ph-arrow-right"></i>
                    </a>
                </div>
            @else
                <div class="status-header">
                    <h2><i class="ph-fill ph-identification-badge"></i> Membership Overview</h2>
                    @if($membership->status === 'active')
                        <div class="badge active"><i class="ph-bold ph-check-circle"></i> Active</div>
                    @elseif($membership->status === 'pending')
                        <div class="badge pending"><i class="ph-bold ph-clock"></i> Pending Approval</div>
                    @else
                        <div class="badge expired"><i class="ph-bold ph-x-circle"></i> Expired</div>
                    @endif
                </div>

                <div class="stats-grid">
                    <div class="stat-box">
                        <div class="stat-label">Current Tier</div>
                        <div class="stat-value highlight">
                            @if($membership->tier == 'Bronze') <i class="ph-fill ph-medal" style="color:#CD7F32;"></i>
                            @elseif($membership->tier == 'Silver') <i class="ph-fill ph-medal" style="color:#C0C0C0;"></i>
                            @elseif($membership->tier == 'Gold') <i class="ph-fill ph-medal" style="color:#FFD700;"></i>
                            @else <i class="ph-fill ph-medal"></i> @endif
                            {{ $membership->tier }}
                        </div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">Points Balance</div>
                        <div class="stat-value">
                            <i class="ph-fill ph-coin" style="color:var(--warning);"></i> 
                            {{ number_format($membership->points) }}
                        </div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-label">Valid Until</div>
                        <div class="stat-value" style="font-size: 1.6rem;">
                            {{ $membership->expires_at ? $membership->expires_at->format('M d, Y') : 'N/A' }}
                        </div>
                    </div>
                </div>

                @if($membership->status === 'pending')
                    <div class="msg info" style="margin-top: 1rem; border-radius: 12px; background: rgba(56, 189, 248, 0.05);">
                        <i class="ph-bold ph-info" style="font-size: 1.5rem;"></i>
                        Your payment ({{ strtoupper($membership->payment_method) }}) is under review. Features will unlock upon approval.
                    </div>
                @endif
            @endif
        </div>

        @if($membership)
            <!-- Upcoming Mall Events Section -->
            <div class="history-section">
                <h3 class="history-title"><i class="ph-bold ph-calendar"></i> Upcoming Mall Events</h3>
                
                @if(isset($events) && $events->count() > 0)
                    <div class="history-grid" style="grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 1.5rem;">
                        @foreach($events as $evt)
                            <div class="history-card" style="align-items: flex-start; padding: 0; overflow: hidden; border-left: 4px solid
                                @if($evt->type === 'car_show') var(--primary)
                                @elseif($evt->type === 'small_concert') var(--secondary)
                                @elseif($evt->type === 'art_gallery') var(--accent)
                                @else var(--success) @endif ;">

                                {{-- Banner image --}}
                                @if($evt->image)
                                    <div style="width: 100%; height: 160px; overflow: hidden; flex-shrink: 0;">
                                        <img src="{{ $evt->image }}" alt="{{ $evt->title }}"
                                             style="width: 100%; height: 100%; object-fit: cover;"
                                             onerror="this.parentElement.style.display='none'">
                                    </div>
                                @endif

                                <div style="display: flex; align-items: flex-start; gap: 14px; padding: 1.1rem 1.25rem; width: 100%;">
                                    <div class="history-icon" style="flex-shrink: 0;
                                        @if($evt->type === 'car_show') background: rgba(56, 189, 248, 0.15); color: var(--primary);
                                        @elseif($evt->type === 'small_concert') background: rgba(129, 140, 248, 0.15); color: var(--secondary);
                                        @elseif($evt->type === 'art_gallery') background: rgba(244, 114, 182, 0.15); color: var(--accent);
                                        @else background: rgba(16, 185, 129, 0.15); color: var(--success); @endif">
                                        @if($evt->type === 'car_show') <i class="ph-fill ph-car"></i>
                                        @elseif($evt->type === 'small_concert') <i class="ph-fill ph-guitar"></i>
                                        @elseif($evt->type === 'art_gallery') <i class="ph-fill ph-palette"></i>
                                        @else <i class="ph-fill ph-calendar-star"></i> @endif
                                    </div>
                                    <div class="history-info">
                                        <div class="history-name">{{ $evt->title }}</div>
                                        <div class="history-date" style="margin-bottom: 6px; display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                            <span class="badge" style="padding: 2px 8px; font-size: 0.7rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); text-transform: uppercase;">
                                                @if($evt->type === 'car_show') Car Show
                                                @elseif($evt->type === 'small_concert') Concert
                                                @elseif($evt->type === 'art_gallery') Art Gallery
                                                @else Special Event @endif
                                            </span>
                                            <span style="display: flex; align-items: center; gap: 4px;">
                                                <i class="ph ph-calendar-blank"></i> {{ $evt->event_date->format('M d, Y') }}
                                            </span>
                                        </div>
                                        <div style="color: var(--text-muted); font-size: 0.88rem; line-height: 1.5;">
                                            {{ $evt->description ?? "No details provided yet. Don't miss this amazing event!" }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="ph-bold ph-calendar-blank"></i>
                        <h3>No Upcoming Events</h3>
                        <p>There are no events scheduled at this moment. Stay tuned for exciting news!</p>
                    </div>
                @endif
            </div>

            <!-- Notifications Section -->
            <div class="history-section">
                <h3 class="history-title" id="notifications"><i class="ph-bold ph-bell"></i> Notifications & Store Alerts</h3>
                
                @if($notifications->count() > 0)
                    <div class="history-grid" style="grid-template-columns: 1fr; gap: 1rem;">
                        @foreach($notifications as $noti)
                            <div class="notification-card {{ !$noti->is_read ? 'unread' : '' }}">
                                <div class="notification-icon {{ !$noti->is_read ? 'unread' : '' }}">
                                    <i class="ph-fill {{ !$noti->is_read ? 'ph-bell-ringing' : 'ph-bell' }}"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-title">
                                        {{ $noti->title }}
                                        @if(!$noti->is_read)
                                            <span style="font-size: 0.75rem; background: var(--primary); color: #0B0F19; padding: 2px 8px; border-radius: 8px; font-weight: 700; text-transform: uppercase;">New</span>
                                        @endif
                                    </div>
                                    <div class="notification-desc">{{ $noti->message }}</div>
                                    <div class="notification-time">
                                        <i class="ph ph-clock"></i> {{ $noti->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <div class="notification-actions">
                                    @if(!$noti->is_read)
                                        <form action="{{ route('notifications.read', $noti) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            <button type="submit" class="btn-noti-action" title="Mark as Read">
                                                <i class="ph ph-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('notifications.destroy', $noti) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-noti-action delete" title="Delete Notification">
                                            <i class="ph ph-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="ph-bold ph-bell-slash"></i>
                        <h3>No Notifications</h3>
                        <p>You're all caught up! We will notify you here when stores put products on sale.</p>
                    </div>
                @endif
            </div>

            <!-- Purchase History -->
            <div class="history-section">
                <h3 class="history-title"><i class="ph-bold ph-shopping-bag"></i> Purchase History</h3>
                
                @if($transactions->count() > 0)
                    <div class="history-grid">
                        @foreach($transactions as $tx)
                            <div class="history-card">
                                <div class="history-icon purchase"><i class="ph-fill ph-receipt"></i></div>
                                <div class="history-info">
                                    <div class="history-name">{{ $tx->product->name ?? 'Deleted Product' }}</div>
                                    <div class="history-date">{{ $tx->created_at->format('M d, Y • g:i A') }}</div>
                                </div>
                                <div class="history-meta">
                                    <div class="history-val">₱{{ number_format($tx->amount, 2) }}</div>
                                    <div class="history-points earned">
                                        <i class="ph-bold ph-plus"></i>{{ $tx->points_earned }} pts
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="ph-bold ph-shopping-cart"></i>
                        <h3>No Purchases Yet</h3>
                        <p>Explore the mall to buy items and start earning points.</p>
                    </div>
                @endif
            </div>

            <!-- Reward Redemptions History -->
            <div class="history-section">
                <h3 class="history-title"><i class="ph-bold ph-gift"></i> Reward Redemptions</h3>
                
                @if($redemptions->count() > 0)
                    <div class="history-grid">
                        @foreach($redemptions as $rd)
                            <div class="history-card">
                                <div class="history-icon reward"><i class="ph-fill ph-star"></i></div>
                                <div class="history-info">
                                    <div class="history-name">{{ $rd->reward_name }}</div>
                                    <div class="history-date">{{ $rd->created_at->format('M d, Y • g:i A') }}</div>
                                </div>
                                <div class="history-meta">
                                    <div class="history-val" style="color:var(--success);">Redeemed</div>
                                    <div class="history-points spent">
                                        <i class="ph-bold ph-minus"></i>{{ $rd->points_spent }} pts
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="ph-bold ph-star-slash"></i>
                        <h3>No Rewards Claimed</h3>
                        <p>Accumulate points and exchange them for exciting rewards!</p>
                    </div>
                @endif
            </div>
        @endif

    </div>

</body>
</html>
