<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal Login | NCCC Mall</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0B0F19;
            --bg-card: rgba(30, 41, 59, 0.4);
            --primary: #38BDF8;
            --secondary: #818CF8;
            --text-main: #F8FAFC;
            --text-muted: #94A3B8;
            --border: rgba(255, 255, 255, 0.08);
            --glass-blur: blur(16px);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        
        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: ''; position: absolute;
            top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle at 50% 50%, rgba(56, 189, 248, 0.08) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(129, 140, 248, 0.08) 0%, transparent 40%);
            z-index: -1; animation: pulse-bg 15s infinite alternate ease-in-out;
        }

        @keyframes pulse-bg {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        .auth-card {
            background: var(--bg-card);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border: 1px solid var(--border);
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand {
            font-size: 1.8rem; font-weight: 800; text-align: center; margin-bottom: 2rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }

        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-muted); }
        .form-control {
            width: 100%; background: rgba(0,0,0,0.2); border: 1px solid var(--border);
            color: white; padding: 12px 16px; border-radius: 12px;
            outline: none; transition: all 0.3s; font-size: 1rem;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15);
        }

        .btn-glow {
            width: 100%; background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff; padding: 14px; border: none; border-radius: 12px;
            font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s;
            position: relative; overflow: hidden; margin-top: 1rem;
        }
        
        .btn-glow::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            opacity: 0; transition: opacity 0.3s ease; z-index: 1;
        }
        
        .btn-glow span { position: relative; z-index: 2; }
        .btn-glow:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(56, 189, 248, 0.3); }
        .btn-glow:hover::before { opacity: 1; }

        .error-message { color: #EF4444; font-size: 0.9rem; margin-top: 5px; }
        .admin-badge {
            background: rgba(239, 68, 68, 0.1); color: #EF4444;
            padding: 4px 12px; border-radius: 50px; font-size: 0.8rem; font-weight: 700;
            display: inline-block; border: 1px solid rgba(239, 68, 68, 0.3);
        }
    </style>
</head>
<body>

    <div class="auth-card">
        <div style="text-align: center; margin-bottom: 1rem;">
            <span class="admin-badge">SYSTEM ACCESS</span>
        </div>
        <div class="brand">
            <i class="ph-fill ph-shopping-cart"></i> NCCC Mall
        </div>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Admin Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control" autocomplete="off">
                @error('email') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Admin Password</label>
                <input id="password" type="password" name="password" required class="form-control" autocomplete="off">
                @error('password') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; color: var(--text-muted);">
                    <input id="remember_me" type="checkbox" name="remember" style="width: 16px; height: 16px; accent-color: var(--primary);">
                    <span>Secure Session</span>
                </label>
            </div>

            <button type="submit" class="btn-glow"><span>Authorize Entry</span></button>
        </form>
    </div>

</body>
</html>
