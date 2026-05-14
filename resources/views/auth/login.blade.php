<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login | NCCC Mall</title>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-light: #F8FAFC;
            --text-dark: #0F172A;
            --primary: #4F46E5;
            --secondary: #06B6D4;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Outfit', sans-serif; }
        
        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at top right, rgba(6, 182, 212, 0.1), transparent 50%),
                        radial-gradient(circle at bottom left, rgba(79, 70, 229, 0.05), transparent 40%);
        }

        .auth-card {
            background: white;
            padding: 3rem;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 450px;
        }

        .brand {
            font-size: 1.8rem; font-weight: 800; text-align: center; margin-bottom: 2rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }

        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; margin-bottom: 8px; font-weight: 500; color: #475569; }
        .form-control {
            width: 100%; padding: 12px 16px; border-radius: 12px;
            border: 2px solid #E2E8F0; outline: none; transition: all 0.3s;
            font-size: 1rem;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .btn-primary {
            width: 100%; background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white; padding: 14px; border: none; border-radius: 12px;
            font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2); }

        .auth-links { text-align: center; margin-top: 1.5rem; font-size: 0.95rem; }
        .auth-links a { color: var(--primary); text-decoration: none; font-weight: 600; }
        .error-message { color: #EF4444; font-size: 0.9rem; margin-top: 5px; }
    </style>
</head>
<body>

    <div class="auth-card">
        <div class="brand">
            <i class="ph-fill ph-shopping-cart"></i> NCCC Mall
        </div>
        <h2 style="text-align: center; margin-bottom: 2rem;">Customer Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control">
                @error('email') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" class="form-control">
                @error('password') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; color: #475569;">
                    <input id="remember_me" type="checkbox" name="remember" style="width: 16px; height: 16px;">
                    <span>Remember me</span>
                </label>
            </div>

            <button type="submit" class="btn-primary">Sign In to Dashboard</button>

            <div class="auth-links">
                Don't have a membership? <a href="{{ route('register') }}">Create Account</a>
            </div>
        </form>
    </div>

</body>
</html>
