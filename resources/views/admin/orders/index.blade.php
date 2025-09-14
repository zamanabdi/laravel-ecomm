@extends('layout')

@section('title', 'Manage Orders')

@section('content')
<style>
    .orders-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .orders-table th, .orders-table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
    }
    .orders-table th {
        background: #5b86e5;
        color: #fff;
    }
    .status-select {
        padding: 6px;
        border-radius: 6px;
    }
    .btn-update {
        background: #28a745;
        color: #fff;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
    }
    .btn-update:hover {
        background: #218838;
    }
    .flash-msg {
        background: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
    }
</style>

<div class="container" style="height: calc(100vh - 90px); padding-top:30px;">
    <h2>All Orders</h2>

    @if(session('success'))
        <div class="flash-msg">{{ session('success') }}</div>
    @endif

    <table class="orders-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Total</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Placed At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->name ?? 'Guest' }}</td>
                <td>{{ $order->email }}</td>
                <td>₹{{ number_format($order->total_amount, 2) }}</td>
                <td>{{ strtoupper($order->payment_method) }}</td>
                <td>
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        <select name="status" class="status-select">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="in-transit" {{ $order->status == 'in-transit' ? 'selected' : '' }}>In Transit</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        </select>
                </td>
                <td>{{ date('d M Y, h:i A', strtotime($order->created_at)) }}</td>
                <td>
                        <button type="submit" class="btn-update">Update</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
