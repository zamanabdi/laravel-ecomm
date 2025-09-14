@extends('layout')

@section('title','Confirm Delete Customer')

@section('content')

<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: linear-gradient(135deg, #ff416c, #ff4b2b);
        margin: 0;
        padding: 0;
        color: #fff;
    }

    .confirm-delete-wrapper {
        min-height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .confirm-box {
        background: #fff;
        color: #333;
        padding: 40px 30px;
        border-radius: 12px;
        max-width: 600px;
        width: 100%;
        box-shadow: 0 6px 20px rgba(0,0,0,0.25);
        text-align: center;
        animation: fadeIn 0.6s ease-in-out;
    }

    .confirm-box h2 {
        margin-bottom: 15px;
        color: #e74c3c;
        font-size: 1.8rem;
    }

    .confirm-box p {
        font-size: 1.1rem;
        margin-bottom: 25px;
    }

    .btn {
        border: none;
        border-radius: 6px;
        padding: 12px 22px;
        margin: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-danger {
        background: #e74c3c;
        color: #fff;
    }

    .btn-danger:hover {
        background: #c0392b;
    }

    .btn-secondary {
        background: #95a5a6;
        color: #fff;
    }

    .btn-secondary:hover {
        background: #7f8c8d;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

<div class="confirm-delete-wrapper">
    <div class="confirm-box">
        <h2>⚠ Confirm Delete</h2>
        <p>Are you sure you want to delete customer with ID: 
           <strong>{{ $delete_id }}</strong>?  
           This action cannot be undone.</p>

        <form method="POST" action="deletecustomerfinal">
            @csrf
            @method('DELETE')


            <input type="hidden" name="delete_customer_id" value="{{ $delete_id }}">
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="{{ url('admin/manage_customers') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

@endsection
