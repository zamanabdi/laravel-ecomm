<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Common Header -->
    <header>
        <a href="/" class="logo">Laravel E-Comm</a>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/products">Products</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
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

    <script src="{{ asset('js/carousel.js') }}"></script>

</body>
</html>
