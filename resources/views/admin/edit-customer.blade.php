@extends('layout')

@section('title','Edit Customer')

@section('content')

<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: linear-gradient(135deg, #667eea, #764ba2);
        margin: 0;
        padding: 0;
        color: #fff;
    }

    .edit-customer-wrapper {
        min-height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .edit-form-box {
        background: #fff;
        color: #333;
        padding: 35px 40px;
        border-radius: 14px;
        width: 100%;
        max-width: 600px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.25);
        animation: slideIn 0.6s ease-in-out;
    }

    .edit-form-box h2 {
        margin-bottom: 20px;
        text-align: center;
        font-size: 1.8rem;
        color: #444;
    }

    .form-group {
        margin-bottom: 18px;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: #222;
    }

    input {
        width: 100%;
        padding: 12px 14px;
        border-radius: 6px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 1rem;
        transition: border 0.3s ease;
    }

    input:focus {
        border-color: #667eea;
    }

    .btn {
        border: none;
        border-radius: 6px;
        padding: 12px 20px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: #667eea;
        color: #fff;
        width: 100%;
    }

    .btn-primary:hover {
        background: #4a5bdc;
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

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="edit-customer-wrapper">
    <div class="edit-form-box">
        <h2>Edit Customer</h2>
        <form method="POST" action="updatecustomer">
            @csrf
            @method('PUT')

            
            <input type="hidden" name="customer_id" value="{{ $customer->id }}">

            <!-- Name -->
            <div class="form-group">
                <label for="name">Customer Name</label>
                <input type="text" id="name" name="name" value="{{ $customer->name }}" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Customer Email</label>
                <input type="email" id="email" name="email" value="{{ $customer->email }}" required>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">Customer Address</label>
                <input type="text" id="address" name="address" value="{{ $customer->address }}" required>
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Customer Phone</label>
                <input type="text" id="phone" name="phone" value="{{ $customer->phone }}" required>
            </div>

            

            <button type="submit" class="btn btn-primary">Update Customer</button>
            <a href="{{ url('admin/manage_customers') }}" class="btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection
