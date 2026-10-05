<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style>
        *{box-sizing:border-box}
        body{font-family:system-ui,sans-serif;background:#f1f5f9;display:flex;min-height:100vh;align-items:center;justify-content:center;margin:0}
        .card{background:#fff;padding:2rem;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.08);width:100%;max-width:360px}
        h1{margin:0 0 1rem;font-size:1.4rem}
        label{display:block;font-size:.85rem;margin:.8rem 0 .3rem}
        input{width:100%;padding:.6rem;border:1px solid #cbd5e1;border-radius:8px}
        button{width:100%;margin-top:1.2rem;padding:.7rem;background:#2563eb;color:#fff;border:0;border-radius:8px;cursor:pointer}
        .err{background:#fee2e2;color:#991b1b;padding:.6rem;border-radius:8px;font-size:.85rem;margin-bottom:.8rem}
    </style>
</head>
<body>
<div class="card">
    <h1>Login</h1>
    @if (session('error'))
        <div class="err">{{ session('error') }}</div>
    @endif
    @error('email')
        <div class="err">{{ $message }}</div>
    @enderror
    <form method="POST" action="{{ route('login.process') }}">
        @csrf
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Masuk</button>
    </form>
</div>
</body>
</html>
