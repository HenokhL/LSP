<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Inventory System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { height: 100%; font-family: 'Poppins', sans-serif; }
        .wrapper { display: flex; height: 100vh; overflow: hidden; }
        .hero {
            flex: 0 0 60%;
            background-image: url('https://images.unsplash.com/photo-1551028719-00167b16eac5?w=900&q=85&fit=crop&crop=left');
            background-size: cover;
            background-position: center top;
            position: relative;
        }
        .hero::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 120px; height: 100%;
            background: linear-gradient(to left, #1a2e5a, transparent);
        }
        .panel {
            flex: 0 0 40%;
            background: #1a2e5a;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3.5rem 3rem;
        }
        .panel h1 { font-weight: 700; font-size: 2rem; color: #fff; margin-bottom: 0.35rem; }
        .panel .subtitle { color: rgba(255,255,255,0.55); font-size: 0.8rem; margin-bottom: 2.25rem; }
        .flash-error {
            background: rgba(229,62,62,0.18);
            border: 1px solid rgba(229,62,62,0.5);
            color: #fca5a5;
            border-radius: 6px;
            padding: 0.65rem 0.9rem;
            font-size: 0.82rem;
            margin-bottom: 1.25rem;
        }
        .field { margin-bottom: 1.1rem; }
        .field label { display: block; color: rgba(255,255,255,0.75); font-size: 0.82rem; margin-bottom: 0.45rem; }
        .field input {
            width: 100%;
            padding: 0.7rem 0.9rem;
            background: rgba(255,255,255,0.07);
            border: 1.5px solid rgba(255,255,255,0.18);
            border-radius: 6px;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            outline: none;
        }
        .field input:focus { border-color: rgba(99,179,237,0.7); background: rgba(255,255,255,0.11); }
        .field input::placeholder { color: rgba(255,255,255,0.3); }
        .btn-signin {
            width: 100%;
            padding: 0.78rem;
            margin-top: 0.5rem;
            background: #1B9EA5;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-signin:hover { background: #157f85; }
        @media (max-width: 700px) { .hero { display: none; } .panel { flex: 1; padding: 2rem 1.5rem; } }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="hero"></div>
    <div class="panel">
        <h1>WELCOME BACK</h1>
        <p class="subtitle">Welcome back! Please enter your details.</p>

        @if(session('error'))
            <div class="flash-error">⚠ {{ session('error') }}</div>
        @endif

        <form action="{{ route('auth.doLogin') }}" method="POST">
            @csrf
            <div class="field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                    placeholder="Masukkan Username"
                    value="{{ old('username') }}" autocomplete="username">
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                    placeholder="••••••••••" autocomplete="current-password">
            </div>
            <button type="submit" class="btn-signin">Sign In</button>
        </form>
    </div>
</div>
</body>
</html>