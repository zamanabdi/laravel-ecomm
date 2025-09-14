@extends('layout')

@section('title', $product->title)

@section('content')
<style>
    body {
        background-color: #f8f9fb;
        color: #333;
    }

    .product-page {
        padding: 50px 20px;
    }

    .product-container {
        display: flex;
        flex-wrap: wrap;
        gap: 40px;
    }

    .product-image {
        flex: 1;
        min-width: 320px;
        background: #fff;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        text-align: center;
    }

    .product-image img {
        width: 100%;
        max-height: 400px;
        object-fit: contain;
        transition: transform 0.3s ease;
        cursor: zoom-in;
    }

    .product-image img:hover {
        transform: scale(1.05);
    }

    .product-details {
        flex: 2;
        min-width: 300px;
        background: #fff;
        border-radius: 14px;
        padding: 25px 30px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
    }

    .product-details h1 {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 12px;
        color: #222;
    }

    .product-category {
        font-size: 0.9rem;
        font-weight: 500;
        color: #666;
        margin-bottom: 18px;
    }

    .product-price {
        font-size: 1.6rem;
        font-weight: 700;
        color: #e63946;
        margin-bottom: 20px;
    }

    .product-description {
        font-size: 1rem;
        color: #444;
        line-height: 1.6;
        margin-bottom: 24px;
    }

    .product-actions {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
    }

    .btn-cart {
        background: #007bff;
        border: none;
        padding: 12px 22px;
        border-radius: 6px;
        color: #fff;
        font-weight: 600;
        font-size: 1rem;
        transition: background 0.3s;
    }

    .btn-cart:hover {
        background: #0056b3;
    }

    .btn-wishlist {
        background: #f1f1f1;
        border: none;
        padding: 12px 22px;
        border-radius: 6px;
        color: #333;
        font-weight: 600;
        font-size: 1rem;
        transition: background 0.3s, color 0.3s;
    }

    .btn-wishlist:hover {
        background: #e63946;
        color: #fff;
    }

    .product-specs {
        margin-top: 30px;
    }

    .product-specs h3 {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #222;
    }

    .spec-list {
        list-style: none;
        padding: 0;
    }

    .spec-list li {
        font-size: 0.95rem;
        padding: 6px 0;
        border-bottom: 1px solid #eee;
    }

    /* Size Options */
    .size-options {
        margin: 20px 0;
    }

    .size-options h4 {
        margin-bottom: 10px;
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
    }

    .sizes {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .size-btn {
        padding: 10px 18px;
        border: 1px solid #333;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        background: #fff;
        transition: all 0.2s ease;
    }

    .size-btn:hover {
        background: #333;
        color: #fff;
    }

    .size-btn.active {
        background: #333;
        color: #fff;
    }

    /* Size Chart Modal */
    .size-chart-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background: rgba(0,0,0,0.6);
    }

    .size-chart-content {
        background: #fff;
        margin: 8% auto;
        padding: 20px 30px;
        border-radius: 12px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.2);
        animation: fadeIn 0.3s ease-in-out;
    }

    .size-chart-content h3 {
        margin-bottom: 15px;
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
    }

    .size-chart-content table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .size-chart-content th, 
    .size-chart-content td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
        font-size: 0.95rem;
    }

    .size-chart-content th {
        background: #f4f4f4;
        font-weight: 600;
    }

    .close-btn {
        float: right;
        font-size: 1.5rem;
        cursor: pointer;
        color: #333;
    }

    .close-btn:hover {
        color: #e63946;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

<div class="product-page container">
    <div class="product-container">

        <!-- Product Image -->
        <div class="product-image">
            <img src="{{ $product->img_url }}" alt="{{ $product->title }}">
        </div>

        <!-- Product Details -->
        <div class="product-details">
            <h1>{{ $product->title }}</h1>
            <p class="product-category">Category: {{ ucfirst(str_replace('_', ' ', $product->category)) }}</p>
            <p class="product-price">₹{{ number_format($product->price, 2) }}</p>

            <p class="product-description">{{ $product->description }}</p>

            


            


            <div class="product-actions">
                <!-- Add to cart form (place in your single product blade where the Add to Cart button is) -->
<form action="{{ route('cart.add') }}" method="POST" style="display:inline-block;">
    @csrf

    <!-- product id (hidden) -->
    <input type="hidden" name="product_id" value="{{ $product->id }}">

    @if(in_array($product->category, ['mens_wear', 'womens_wear']))
    <div style="margin:15px 0;">
        <label for="size" style="font-weight:600;">Select Size:</label>
        <select name="size" id="size" required style="padding:8px; border-radius:6px; border:1px solid #ccc; margin-left:8px;">
            <option value="">--Choose Size--</option>
            <option value="S">S - Small</option>
            <option value="M">M - Medium</option>
            <option value="L">L - Large</option>
            <option value="XL">XL - Extra Large</option>
            <option value="2XL">2XL - Double XL</option>
            <option value="3XL">3XL - Triple XL</option>
            <option value="4XL">4XL - Four XL</option>
        </select>

        <!-- 🔗 Size Chart Trigger -->
                    <p style="margin-top:10px;">
                        <a href="javascript:void(0)" id="openSizeChart" style="color:#007bff; font-weight:600;">📏 View Size Chart</a>
                    </p>
    </div>
@endif
    <!-- quantity (user can change if you want) -->
    <label for="qty">Qty</label>
    <input id="qty" type="number" name="quantity" value="1" min="1" style="width:70px; padding:6px; margin-left:8px;">

    <!-- submit -->
    <button type="submit" style="padding:10px 16px; margin-left:12px; background:#007bff; color:#fff; border-radius:6px; border:none; cursor:pointer;">
        🛒 Add to Cart
    </button>
</form>

                
    </div>
            <button class="btn-wishlist">♥ Add to Wishlist</button>

            <div class="product-specs">
                <h3>Specifications</h3>
                <ul class="spec-list">
                    <li>Brand: Example Brand</li>
                    <li>Model: Example Model</li>
                    <li>Warranty: 1 Year</li>
                    <li>Return Policy: 7 Days</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- 🔲 Popup Modal for Size Chart -->
<div id="sizeChartModal" class="size-chart-modal">
    <div class="size-chart-content">
        <span class="close-btn" id="closeSizeChart">&times;</span>
        <h3>Size Chart</h3>
        <table>
            <thead>
                <tr>
                    <th>Size</th>
                    <th>Description</th>
                    <th>Waist</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>S</td><td>Small</td><td>30"</td></tr>
                <tr><td>M</td><td>Medium</td><td>36"</td></tr>
                <tr><td>L</td><td>Large</td><td>38"</td></tr>
                <tr><td>XL</td><td>Extra Large</td><td>40"</td></tr>
                <tr><td>3XL</td><td>Triple XL</td><td>44"</td></tr>
                <tr><td>4XL</td><td>Four XL</td><td>47"</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Handle size selection
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Modal open/close
    const modal = document.getElementById('sizeChartModal');
    const openBtn = document.getElementById('openSizeChart');
    const closeBtn = document.getElementById('closeSizeChart');

    if(openBtn){
        openBtn.onclick = () => modal.style.display = 'block';
    }
    if(closeBtn){
        closeBtn.onclick = () => modal.style.display = 'none';
    }

    // Close modal when clicking outside content
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>
@endsection
