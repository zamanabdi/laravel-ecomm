@extends('layout')

@section('title', 'Sign Up')

@section('content')
    <div class="signup-container">
        <h1>Create Your Account</h1>
        <p class="subtitle">Join Laravel E-Comm and start shopping today 🎉</p>

        <form action="create-new-customer" method="post" class="signup-form">
            @csrf

            <label for="username">Username</label>
            <input type="text" id="username" name="name" placeholder="Enter your username">

            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Enter your email">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">

            <label for="address">Address</label>
            <input type="text" id="address" name="address" placeholder="Enter your address">

            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="Enter your phone number">

            <label for="role">Role</label>
            <select id="role" name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <button type="submit" class="signup-btn">Sign Up</button>
        </form>

        <p class="login-link">Already have an account? <a href="login-form">Login here</a></p>
    </div>
@endsection

<style>
    .signup-container {
        max-width: 450px;
        margin: 40px auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        text-align: center;
    }

    .signup-container h1 {
        color: #1f2937;
        margin-bottom: 10px;
    }

    .signup-container .subtitle {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .signup-form {
        text-align: left;
    }

    .signup-form label {
        display: block;
        margin: 12px 0 6px;
        font-weight: bold;
        color: #374151;
    }

    .signup-form input,
    .signup-form select {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        font-size: 14px;
    }

    .signup-btn {
        margin-top: 20px;
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 6px;
        background: #10b981;
        color: white;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }

    .signup-btn:hover {
        background: #059669;
    }

    .login-link {
        margin-top: 15px;
        font-size: 14px;
    }

    .login-link a {
        color: #2563eb;
        text-decoration: none;
        font-weight: bold;
    }

    .login-link a:hover {
        text-decoration: underline;
    }
</style>
