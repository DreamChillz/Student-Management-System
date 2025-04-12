<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="login-container">
        <div class="header">
            <h1 class="header-text">Welcome Back</h1>
            <h2 class="header-text">Student Management System</h2>
            <h4 class="subtitle">Please login to the system</h4>
        </div>

        <div class="login-form">
            @if (session('error'))
                <div style="color: red; margin-bottom:10px">{{ session('error') }}</div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-field">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-field">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <div class="login-button-div">
                    <button class="login-button" type="submit">Login</button>
                </div>
            </form>

        </div>


    </div>
</body>

</html>
