@extends('layout')

@section('title','Edit Profile')

@section('content')

<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: linear-gradient(135deg, #36d1dc, #5b86e5);
        margin: 0;
        padding: 0;
        color: #fff;
    }

    .profile-edit-wrapper {
        min-height: 85vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
    }

    .profile-edit-box {
        background: #fff;
        color: #333;
        padding: 40px 45px;
        border-radius: 16px;
        width: 100%;
        max-width: 650px;
        box-shadow: 0 8px 22px rgba(0,0,0,0.25);
        animation: fadeIn 0.7s ease-in-out;
    }

    .profile-edit-box h2 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 2rem;
        font-weight: 700;
        color: #444;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #222;
    }

    input {
        width: 100%;
        padding: 12px 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 1rem;
        transition: border 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus {
        border-color: #5b86e5;
        box-shadow: 0 0 6px rgba(91,134,229,0.4);
    }

    .btn {
        border: none;
        border-radius: 8px;
        padding: 14px 20px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .btn-primary {
        background: #5b86e5;
        color: #fff;
        width: 100%;
        margin-top: 10px;
    }

    .btn-primary:hover {
        background: #4169d8;
    }

    .btn-secondary {
        background: #95a5a6;
        color: #fff;
        display: inline-block;
        margin-top: 12px;
        text-align: center;
        width: 100%;
        text-decoration: none;
        line-height: 2.5rem;
    }

    .btn-secondary:hover {
        background: #7f8c8d;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="profile-edit-wrapper">
    <div class="profile-edit-box">
        <h2>Edit Profile</h2>
        <form method="POST" action="updateprofile">
            @csrf
            @method('PUT')


            <input type="hidden" name="user_id" value="{{ $customer->id }}">

            <!-- Name -->
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ $customer->name }}" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ $customer->email }}" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" placeholder="Leave blank if not changing">
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="{{ $customer->address }}" required>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" value="{{ $customer->phone }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="{{ url('/') }}" class="btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection
