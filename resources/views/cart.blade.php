@extends('layout')

@section('title', 'Your Cart')

@section('content')
<style>
    body { font-family: "Segoe UI", Tahoma, sans-serif; background: linear-gradient(135deg,#f6d365,#fda085); margin:0; padding:0; color:#333; }
    .cart-wrapper { min-height:80vh; padding:30px 20px; display:flex; justify-content:center; align-items:flex-start; }
    .cart-box { background:#fff; width:100%; max-width:1100px; border-radius:12px; padding:20px; box-shadow:0 8px 30px rgba(0,0,0,0.12); }
    h2 { text-align:center; margin-bottom:12px; color:#333; }
    table { width:100%; border-collapse:collapse; margin-top:10px; }
    th, td { padding:12px 10px; border-bottom:1px solid #eee; text-align:left; vertical-align: middle; }
    th { background:#fafafa; font-weight:700; color:#222; }
    .product-thumb { width:70px; height:70px; object-fit:cover; border-radius:6px; border:1px solid #eee; }
    .qty-input { width:80px; padding:8px; border-radius:6px; border:1px solid #ccc; }
    .btn { border:none; border-radius:8px; padding:8px 12px; font-weight:700; cursor:pointer; text-decoration:none; color:#fff; }
    .btn-update { background:#5b86e5; }
    .btn-remove { background:#e74c3c; }
    .btn-clear { background:#95a5a6; color:#fff; }
    .cart-summary { margin-top:18px; display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap; }
    .total { font-size:1.3rem; font-weight:800; color:#222; }
    .empty { text-align:center; padding:30px; color:#666; }
</style>

<div class="cart-wrapper">
    <div class="cart-box">
        <h2>Your Cart</h2>

        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div style="padding:10px; background:#e7f9ee; color:#2d7a4b; border-radius:6px; margin-bottom:10px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="padding:10px; background:#fdecea; color:#a33; border-radius:6px; margin-bottom:10px;">
                {{ session('error') }}
            </div>
        @endif

        {{-- If cart empty --}}
        @if(count($cart) === 0)
            <div class="empty">
                <p>Your cart is empty.</p>
                <a href="{{ url('/') }}" style="text-decoration:none; color:#5b86e5; font-weight:700;">Continue shopping</a>
            </div>
        @else
            @php $total = 0; @endphp

            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th style="width:160px;">Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <div style="display:flex; gap:12px; align-items:center;">
                                    @if($item['img_url'])
                                        <img src="{{ $item['img_url'] }}" alt="{{ $item['title'] }}" class="product-thumb">
                                    @endif
                                    <div>
                                        <div style="font-weight:700;">{{ $item['title'] }}</div>
                                        <div style="font-size:0.9rem; color:#666;">Product ID: {{ $item['id'] }}</div>
                                        @if($item['size'])
                                          <div style="font-size:0.9rem; color:#666;">Size: {{ $item['size']}}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td>₹{{ number_format($item['price'], 2) }}</td>

                            <td>
                                <!-- Update quantity form -->
                                <form action="{{ route('cart.update') }}" method="POST" style="display:flex; gap:8px; align-items:center;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="qty-input">
                                    <button type="submit" class="btn btn-update">Update</button>
                                </form>
                            </td>

                            <td>₹{{ number_format($subtotal, 2) }}</td>

                            <td>
                                <!-- Remove form -->
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                    <button type="submit" class="btn btn-remove">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="cart-summary">
                <div class="total">Total: ₹{{ number_format($total, 2) }}</div>

                <div style="display:flex; gap:12px;">
                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Clear cart?');">
                        @csrf
                        <button type="submit" class="btn btn-clear">Clear Cart</button>
                    </form>

                    <a href="{{ url('checkout') }}" class="btn btn-update" style="text-decoration:none; display:inline-block; line-height:28px;">Proceed to Checkout</a>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
