@extends('layout')

@section('title', 'Checkout')

@section('content')
<style>
    

    .checkout-wrapper {
        font-family: "Segoe UI", Tahoma, sans-serif;
    background: linear-gradient(135deg, #dfe9f3, #ffffff);
    min-height: 80vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 30px 20px;
    color: #333;

    }

    .checkout-box {
        background: #fff;
        width: 100%;
        max-width: 700px;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #444;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: #555;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    textarea {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 1rem;
    }

    textarea {
        resize: vertical;
    }

    .payment-methods {
        margin: 15px 0;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .payment-methods label {
        font-weight: normal;
        margin-right: 20px;
        cursor: pointer;
    }

    .btn-submit {
        background: #5b86e5;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        display: block;
        margin: 0 auto;
    }

    .btn-submit:hover {
        background: #4a6cd1;
    }

    .btn-razorpay {
        background: #f37254;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        display: none; /* hidden until Razorpay is selected */
        margin: 0 auto;
    }

    .btn-razorpay:hover {
        background: #d55a3e;
    }
</style>

<div class="checkout-wrapper">
    <div class="checkout-box">
        <h2>Checkout</h2>

        <form id="checkout-form" action="{{ route('checkout.placeOrder') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required value="{{ $customer->name }}">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required value="{{ $customer->email }}">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required value="{{ $customer->phone }}">
            </div>

            <div class="form-group">
                <label for="address">Shipping Address</label>
                <textarea id="address" name="address" rows="3" required>{{ $customer->address }}</textarea>
            </div>

            <div class="payment-methods">
                <strong>Select Payment Method:</strong><br><br>
                <label>
                    <input type="radio" name="payment_method" value="cod" required>
                    Cash on Delivery
                </label>
                <label>
                    <input type="radio" name="payment_method" value="razorpay" required>
                    Pay Online (Razorpay)
                </label>
            </div>

            @if($customer)
            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
            @endif

            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">

            <!-- COD button -->
            <button type="submit" id="cod-button" class="btn-submit">Place Order</button>

            <!-- Razorpay button -->
            <button type="button" id="razorpay-button" class="btn-razorpay">Pay with Razorpay</button>
        </form>
    </div>
</div>

@section('scripts')
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ env('RAZORPAY_KEY') }}",
        "amount": "{{ $totalAmount * 100 }}",
        "currency": "INR",
        "name": "My Shop",
        "description": "Order Payment",
        "order_id": "{{ $razorpayOrderId ?? '' }}",
        "handler": function (response){
            // Fill hidden input with payment_id then submit form
            document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
            document.getElementById('checkout-form').submit();
        },
        "prefill": {
            "name": "{{ $customer->name }}",
            "email": "{{ $customer->email }}",
            "contact": "{{ $customer->phone }}"
        },
        "theme": {
            "color": "#5b86e5"
        }
    };

    var rzp1 = new Razorpay(options);

    // Toggle buttons based on payment method
    document.querySelectorAll('input[name="payment_method"]').forEach(el => {
        el.addEventListener('change', function() {
            if (this.value === 'razorpay') {
                document.getElementById('cod-button').style.display = 'none';
                document.getElementById('razorpay-button').style.display = 'block';
            } else {
                document.getElementById('cod-button').style.display = 'block';
                document.getElementById('razorpay-button').style.display = 'none';
            }
        });
    });

    // Launch Razorpay on button click
    document.getElementById('razorpay-button').onclick = function(e){
        rzp1.open();
        e.preventDefault();
    }
</script>
@endsection
