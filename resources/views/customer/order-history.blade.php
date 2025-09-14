@extends('layout')

@section('title', 'My Orders')

@section('content')
<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: #f8fafc;
        margin: 0;
        padding: 0;
    }

    .orders-container {
        max-width: 1000px;
        margin: 40px auto;
        height: 100%;
        padding: 20px;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    th, td {
        padding: 15px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }

    th {
        background: #5b86e5;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    tr:hover {
        background: #f1f5f9;
    }

    .status {
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: bold;
        text-transform: capitalize;
    }

    .status.pending { background: #fff3cd; color: #856404; }
    .status.paid { background: #d4edda; color: #155724; }
    .status.cancelled { background: #f8d7da; color: #721c24; }
</style>

<div class="orders-container">
    <h2>My Order History</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Total Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ date('d M Y, h:i A', strtotime($order->created_at)) }}</td>
                    <td>₹{{ number_format($order->total_amount, 2) }}</td>
                    <td>{{ strtoupper($order->payment_method) }}</td>
                    <td>
                        <span class="status {{ $order->status }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>
                        <a href="/orders/{{$order->id}}" style="color:#5b86e5; text-decoration:none; font-weight:600;">
                            View Details
                        </a>
@if($order->status === 'pending')
    <form action="/orders/cancel/{{$order->id}}" method="POST" style="display:inline;">
        @csrf
        @method('PATCH')
        <button type="submit" 
            style="background:#e74c3c; 
                   color:#fff; 
                   border:none; 
                   padding:8px 14px;
                   margin-top:5px; 
                   border-radius:6px; 
                   font-size:0.9rem; 
                   font-weight:600; 
                   cursor:pointer;">
            Cancel Order
        </button>
    </form>
@endif

                    </td>
                </tr>
                
            @if(!$orders)
                <tr>
                    <td colspan="6">You have not placed any orders yet.</td>
                </tr>
                @endif
                
            @endforeach
        </tbody>
    </table>
</div>
@endsection
