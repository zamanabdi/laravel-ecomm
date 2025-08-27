@extends('layout')

@section('title', 'Login')

@section('content')
    <div class="login-container">
        <h1>Welcome Back 👋</h1>
        <p class="subtitle">Login to continue shopping with Laravel E-Comm</p>

        <form action="login-request" method="POST" class="login-form">
            @csrf

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <p class="signup-link">Don't have an account? <a href="signup-form">Sign up here</a></p>
    </div>
@endsection

<style>
    .login-container {
        max-width: 400px;
        margin: 50px auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        text-align: center;
    }

    .login-container h1 {
        color: #1f2937;
        margin-bottom: 10px;
    }

    .login-container .subtitle {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .login-form {
        text-align: left;
    }

    .login-form label {
        display: block;
        margin: 12px 0 6px;
        font-weight: bold;
        color: #374151;
    }

    .login-form input {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        font-size: 14px;
    }

    .login-btn {
        margin-top: 20px;
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 6px;
        background: #3b82f6;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }

    .login-btn:hover {
        background: #2563eb;
    }

    .signup-link {
        margin-top: 15px;
        font-size: 14px;
    }

    .signup-link a {
        color: #10b981;
        text-decoration: none;
        font-weight: bold;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }
</style>
