@extends('layout')

@section('title', 'All Products')

@section('content')
<style>
    body {
        background-color: #f8f9fb;
        color: #333;
    }

    .products-section {
        padding: 50px 20px;
    }

    .products-section h1 {
        text-align: center;
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 40px;
        color: #222;
    }

    .product-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.08);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .product-img {
        position: relative;
        overflow: hidden;
        height: 220px;
        background: #f4f4f4;
    }

    .product-img img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.4s ease;
    }

    .product-card:hover .product-img img {
        transform: scale(1.08);
    }

    .card-body {
        padding: 16px 18px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .card-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 6px;
        color: #111;
        line-height: 1.3;
        min-height: 40px; /* keeps uniform height */
    }

    .card-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: #e63946;
        margin-bottom: 12px;
    }

    .card-text {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 14px;
        flex-grow: 1;
    }

    .btn-view {
        background: #007bff;
        border: none;
        padding: 9px 14px;
        border-radius: 6px;
        color: #fff;
        font-weight: 500;
        font-size: 0.9rem;
        transition: background 0.3s;
        text-align: center;
    }

    .btn-view:hover {
        background: #0056b3;
    }

    /* Badge (optional) */
    .product-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #28a745;
        color: #fff;
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 8px;
        border-radius: 6px;
    }
</style>

<div class="products-section container">
    <h1>Our Products</h1>

    <div class="row">
        @foreach($data as $product)
            <div class="col-md-3 mb-4">
                <div class="product-card">
                    <div class="product-img">
                        <img src="{{ $product->img_url }}" alt="{{ $product->title }}">
                        <span class="product-badge">New</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-price">₹{{ number_format($product->price, 2) }}</p>
                        <p class="card-text">{{ Str::limit($product->description, 60) }}</p>
                        <a style="text-decoration: none;" href="/product?product_id={{$product->id}}" class="btn-view mt-auto">View Details</a>
                    </div>
                </div>
            </div>
       @endforeach
    </div>
</div>
@endsection
