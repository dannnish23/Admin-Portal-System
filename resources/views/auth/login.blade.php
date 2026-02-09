<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-container">

    <div class="auth-card">

        <h2>Welcome Back</h2>
        <p class="subtitle">Please login to continue</p>

        <form method="POST" action="/login">
            @csrf

            @if ($errors->any())
            <div class="error-box">
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

            <label>Email</label>
            <input type="email" name="email" class="auth-input" required>

            <label>Password</label>
            <input type="password" name="password" class="auth-input" required>

            <button type="submit" class="auth-btn">Login</button>
        </form>

        <p class="register-text">
            No account? <a href="/register">Create one</a>
        </p>

    </div>

</div>

</body>
</html>
