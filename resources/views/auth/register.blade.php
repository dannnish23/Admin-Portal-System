<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-container">

    <div class="auth-card">

        <h2>Create Account</h2>
        <p class="subtitle">Register to access the system</p>

        <form method="POST" action="/register">
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

            <label>Name</label>
            <input type="text" name="name" class="auth-input" required>

            <label>Email</label>
            <input type="email" name="email" class="auth-input" required>

            <label>Password</label>
            <input type="password" name="password" class="auth-input" required>

            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="auth-input" required>

            <button type="submit" class="auth-btn">Register</button>
        </form>

        <p class="register-text">
            Already have account? <a href="/login">Login</a>
        </p>

    </div>

</div>

</body>
</html>
