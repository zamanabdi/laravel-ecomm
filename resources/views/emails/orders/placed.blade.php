<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">

    <div style="max-width: 600px; margin: auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

        <h2 style="color: #333;">Hi {{ $order['name'] }},</h2>
        <p style="font-size: 15px; color: #555;">
            Thank you for your order! 🎉 Your order has been placed successfully.
        </p>

        <h3 style="margin-top: 20px; color: #444;">Order Summary</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #eee;"><strong>Order ID:</strong></td>
                <td style="padding: 8px; border-bottom: 1px solid #eee;">#{{ $order['id'] }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #eee;"><strong>Total Amount:</strong></td>
                <td style="padding: 8px; border-bottom: 1px solid #eee;">₹{{ number_format($order['total'], 2) }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border-bottom: 1px solid #eee;"><strong>Payment Method:</strong></td>
                <td style="padding: 8px; border-bottom: 1px solid #eee;">{{ strtoupper($order['payment_method']) }}</td>
            </tr>
            
            <tr>
                <td style="padding: 8px;"><strong>Shipping Address:</strong></td>
                <td style="padding: 8px;">{{ $order['address'] }}</td>
            </tr>
        </table>

        <p style="margin-top: 20px; font-size: 14px; color: #666;">
            We’ll notify you when your order is shipped. You can also track your order from your dashboard.
        </p>

        <p style="margin-top: 30px; font-size: 15px; font-weight: bold; color: #333;">
            — {{ config('app.name') }} Team
        </p>
    </div>

</body>
</html>
