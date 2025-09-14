@php
    $cart = session('cart', []);
    $cartQuantity = array_sum(array_column($cart, 'quantity'));
@endphp



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <!-- Common Header -->
    <header>
        <a href="/" class="logo">Laravel E-Comm</a>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/all_products">Products</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
                @if(session('customer') && session('customer.role') === 'admin')
                <li><a href="/admin/dashboard">Admin</a></li>

                @elseif(session('customer') && session('customer.role') == 'user')

                <li><a href="/user/dashboard">Profile</a></li>
                <li><a href="{{ route('cart.show') }}">
                    <i style="font-size: 20px;" class="fa-solid fa-cart-shopping"></i>
                    @if(session('cart'))
                    <span style="background-color: orangered; color:white; padding:5px 8px; border-radius:15px; font-size:11.5px; font-weight:bold; position:relative; top:-15px; right:10px;">{{$cartQuantity}}</span>
                    @endif
                </a></li>

                @endif
            </ul>
        </nav>
        <div class="auth-buttons">
            <a href="login-form" class="btn-login">Login</a>
            <a href="signup-form" class="btn-signup">Sign Up</a>
        </div>
    </header>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

      <!-- Common Footer -->
    <footer>
        <div class="footer-links">
            <a href="/privacy">Privacy Policy</a>
            <a href="/terms">Terms of Service</a>
            <a href="/contact">Contact Us</a>
        </div>
        <p>© {{ date('Y') }} Laravel E-Comm. All rights reserved.</p>
    </footer>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="{{ asset('js/carousel.js') }}"></script>

    @yield('scripts')
</body>
</html>
