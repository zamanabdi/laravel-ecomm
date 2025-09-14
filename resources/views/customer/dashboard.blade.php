@extends('layout')

@section('title', 'User Dashboard')

@section('content')
<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: linear-gradient(135deg, #43cea2, #185a9d);
        margin: 0;
        padding: 0;
        color: #fff;
    }

    .dashboard-container {
        display: flex;
        min-height: 80vh;
    }

    /* Sidebar */
    .sidebar {
        width: 220px;
        background: rgba(0, 0, 0, 0.2);
        padding: 20px;
        border-radius: 12px;
        margin-right: 20px;
    }

    .sidebar h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 20px;
        border-bottom: 1px solid rgba(255,255,255,0.3);
        padding-bottom: 10px;
    }

    .sidebar a {
        display: block;
        text-decoration: none;
        color: #fff;
        padding: 10px 15px;
        margin: 8px 0;
        border-radius: 8px;
        transition: background 0.3s;
    }

    .sidebar a:hover {
        background: rgba(255,255,255,0.2);
    }

    .sidebar a.active {
        background: rgba(255,255,255,0.3);
        font-weight: bold;
    }

    /* Main Content */
    .main-content {
        flex: 1;
        padding: 20px;
    }

    .main-content h1 {
        font-size: 26px;
        margin-bottom: 20px;
    }

    .stats {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .card {
        flex: 1;
        min-width: 200px;
        background: rgba(255,255,255,0.15);
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        backdrop-filter: blur(5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card h2 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .card p {
        font-size: 18px;
        font-weight: bold;
    }
</style>

<div class="dashboard-container">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>User Panel</h2>
        <a href="#" class="active">🏠 Dashboard</a>
        <a href="dashboard/orders">🛒 My Orders</a>
        <a href="#">💳 Wallet</a>
        <a href="#">🔔 Notifications</a>
        <a href="dashboard/editmyprofile">👤 Profile</a>

            
            <button style="background-color:red; color:white; font-weight:bold; border:none; width:100%; border-radius:8px; ">
                <a style="text-decoration: none; color:inherit; font-size:14px;" href="/logout">
                    ⚙ Logout
                </a>
            </button>
        
    </div>

    
    <!-- Main Content -->
    <div class="main-content">
        <h1>Welcome, {{session('customer.name')}} 👋</h1>
        <p style="margin-bottom: 20px;">Here’s a quick overview of your account:</p>

        <div class="stats">
            <div class="card">
                <h2>My Orders</h2>
                <p>0</p>
            </div>
            <div class="card">
                <h2>Wallet Balance</h2>
                <p>0</p>
            </div>
            <div class="card">
                <h2>Notifications</h2>
                <p>0</p>
            </div>
            <div class="card">
                <h2>Profile Completed</h2>
                <p>0</p>
            </div>
        </div>
    </div>


</div>
@endsection
