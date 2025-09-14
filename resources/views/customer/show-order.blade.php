@extends('layout')

@section('title', 'Order Details')

@section('content')
<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: #f8fafc;
        margin: 0;
        padding: 0;
    }

    .order-container {
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
    }

    .order-box {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }

    .order-info {
        margin-bottom: 25px;
    }

    .order-info p {
        margin: 5px 0;
        font-size: 1rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }

    th {
        background: #5b86e5;
        color: #fff;
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

    .total {
        text-align: right;
        margin-top: 15px;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .back-link {
        display: inline-block;
        margin-top: 20px;
        color: #5b86e5;
        text-decoration: none;
        font-weight: 600;
    }
</style>

<div class="order-container">
    <div class="order-box">
        <h2>Order #{{ $order->id }}</h2>

        <div class="order-info">
            <p><strong>Date:</strong> {{ date('d M Y, h:i A', strtotime($order->created_at)) }}</p>
            <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
            <p><strong>Status:</strong> <span class="status {{ $order->status }}">{{ $order->status }}</span></p>
            <p><strong>Shipping Address:</strong> {{ $order->address }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->size ?? '-' }}</td>
                    <td>₹{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($item->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Total: ₹{{ number_format($order->total_amount, 2) }}</p>

        <a href="/user/dashboard/orders" class="back-link">← Back to Orders</a>
    </div>
</div>
@endsection
