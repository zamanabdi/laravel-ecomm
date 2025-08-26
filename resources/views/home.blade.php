@extends('layout')

@section('title', 'Home')

@section('content')
    <style>



        /* ---------- HERO SECTION ---------- */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                        url('https://images.pexels.com/photos/5650050/pexels-photo-5650050.jpeg') center/cover no-repeat;
            color: #fff;
            text-align: center;
            padding: 120px 20px;
            border-radius: 12px;
            margin-bottom: 50px;
            margin-left: 15px;
            margin-right: 15px;
        }
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
        }
        .hero .btn-shop {
            background: #fbbf24;
            color: #111;
            padding: 14px 30px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            transition: 0.3s;
        }
        .hero .btn-shop:hover {
            background: #f59e0b;
        }

        /* ---------- CAROUSEL (dummy static for now) ---------- */
       .carousel-section {
    position: relative;
    margin: 40px auto;
    max-width: 90%;
}

.carousel-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.carousel {
    display: flex;
    overflow-x: auto;
    scroll-behavior: smooth;
    gap: 10px;
    scrollbar-width: none; /* hide scrollbar in Firefox */
}
.carousel::-webkit-scrollbar {
    display: none; /* hide scrollbar in Chrome/Safari */
}

.carousel img {
    flex-shrink: 0;
    width: 400px;
    height: 250px;
    border-radius: 8px;
    object-fit: contain;
}

.carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.6);
    color: #fff;
    border: none;
    width: 45px;       /* fixed width */
    height: 45px;      /* fixed height */
    border-radius: 50%; /* perfect circle */
    cursor: pointer;
    font-size: 20px;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center; /* center the arrow inside */
}

.carousel-btn.left {
    left: -25px;
}

.carousel-btn.right {
    right: -25px;
}

.carousel-btn:hover {
    background: rgba(0,0,0,0.8);
}



        /* ---------- ADVERTISEMENT SECTION ---------- */
        .ads {
            display: flex;
            gap: 20px;
            margin: 50px 15px;
        }
        .ads img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* ---------- FEATURED PRODUCTS ---------- */
        .products {
            text-align: center;
        }
        .products h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .product {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 15px;
            transition: box-shadow 0.3s;
        }
        .product:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .product img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .product h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }
        .product p {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 10px;
        }
        .product .price {
            font-size: 16px;
            font-weight: bold;
            color: #111827;
        }
    </style>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome to Laravel E-Comm 🚀</h1>
        <p>Shop the latest products at unbeatable prices!</p>
        <a href="/products" class="btn-shop">Shop Now</a>
    </section>

    <!-- Carousel Section -->
    <section class="carousel-section">
    <h2 style="margin-bottom:10px;">Featured Products</h2>
    <div class="carousel-wrapper">
        <button class="carousel-btn left" onclick="slideLeft()">&#10094;</button>
        <div class="carousel" id="carousel">
            <img src="https://m.media-amazon.com/images/I/81YQfMvc76L._SL1500_.jpg" alt="Product 1">
            <img src="https://m.media-amazon.com/images/I/81RSrpHOiaL._SX679_.jpg" alt="Product 2">
            <img src="https://m.media-amazon.com/images/I/81a+7L07LML._SX575_.jpg" alt="Product 3">
            <img src="https://m.media-amazon.com/images/I/8133GVuhgwL._SL1500_.jpg" alt="Product 4">
            <img src="https://m.media-amazon.com/images/I/51T5YQij9sL.jpg" alt="Product 5">
            <img src="https://m.media-amazon.com/images/I/51RaySTbIVL._SL1500_.jpg" alt="Product 6">
            <img src="https://m.media-amazon.com/images/I/617DaZix1gL._SY879_.jpg" alt="Product 7">
        </div>
        <button class="carousel-btn right" onclick="slideRight()">&#10095;</button>
    </div>
</section>



    <!-- Advertisement Section -->
    <section class="ads">
        <img src="https://images.pexels.com/photos/8638307/pexels-photo-8638307.jpeg" alt="Ad 1">
        <img src="https://images.pexels.com/photos/6438287/pexels-photo-6438287.jpeg" alt="Ad 2">
    </section>

    <!-- Featured Products Grid -->
    <section class="products">
        <h2>Our Top Picks</h2>
        <div class="product-grid">
            <div class="product">
                <img src="https://m.media-amazon.com/images/I/71J-rFs7JvL._SX575_.jpg" alt="Product">
                <h3>Product Name</h3>
                <p>Short product description goes here.</p>
                <span class="price">$49.99</span>
            </div>
            <div class="product">
                <img src="https://m.media-amazon.com/images/I/81r5IdEJieL._SL1500_.jpg" alt="Product">
                <h3>Product Name</h3>
                <p>Short product description goes here.</p>
                <span class="price">$39.99</span>
            </div>
            <div class="product">
                <img src="https://m.media-amazon.com/images/I/61zsBElkHyL._SL1500_.jpg" alt="Product">
                <h3>Product Name</h3>
                <p>Short product description goes here.</p>
                <span class="price">$59.99</span>
            </div>
        </div>
    </section>
@endsection
