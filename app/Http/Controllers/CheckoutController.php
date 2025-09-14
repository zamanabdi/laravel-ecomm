<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlacedMail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    //
    public function index(Request $req)
{
    $sessionCustomer = $req->session()->get('customer');
    $currId = $sessionCustomer['id'];

    $customer = \App\Models\Customer::find($currId);

    // ✅ Get cart from session
    $cart = session()->get('cart', []);

    // ✅ Calculate total amount
    $totalAmount = 0;
    foreach ($cart as $item) {
        $totalAmount += $item['price'] * $item['quantity'];
    }

    // ✅ Create Razorpay order only if cart is not empty
    $razorpayOrderId = null;
    if (!empty($cart)) {
        $api = new \Razorpay\Api\Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $order = $api->order->create([
            'receipt'         => 'rcptid_' . time(),
            'amount'          => $totalAmount * 100, // amount in paise
            'currency'        => 'INR',
            'payment_capture' => 1, // auto-capture
        ]);
        $razorpayOrderId = $order['id'];
    }

    return view('checkout-page', compact('customer', 'totalAmount', 'razorpayOrderId'));
}




    public function placeOrder(Request $req){

       $validated = $req->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:15',
        'address' => 'required|string',
        'payment_method' => 'required|in:cod,razorpay',
    ]);

     // Get customer ID from session
   $sessionCustomer = $req->session()->get('customer');
   $customer_Id = $sessionCustomer['id'];

   // Get cart from session
   $cart = session()->get('cart',[]);

    if (empty($cart)) {
        return redirect()->back()->with('error', 'Cart is empty!');
    }

     // Calculate total
     $total = 0;
     foreach($cart as $item){
      $total += $item['price'] * $item['quantity'];
     }


     $status = 'pending';
$razorpayPaymentId = $req->input('razorpay_payment_id');

if ($validated['payment_method'] === 'razorpay' && !empty($razorpayPaymentId)) {
    $status = 'paid';
}

     // Insert order into `orders` table
     $orderId = DB::table('orders')->insertGetId([
       'customer_id' => $customer_Id,
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'address' => $validated['address'],
        'payment_method' => $validated['payment_method'],
        'status' => $status, // default
        'total_amount' => $total,
        'created_at' => now(),
        'updated_at' => now(),
     ]);


     foreach($cart as $item){
      DB::table('order_items')->insert([
        'order_id' => $orderId,
            'product_id' => $item['id'],
            'product_name' => $item['title'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'subtotal' => $item['price'] * $item['quantity'],
            'size' => $item['size'] ?? NULL,
            'created_at' => now(),
            'updated_at' => now(),
      ]);
     }


   // Prepare order data for email
$orderData = [
    'id'             => $orderId,
    'name'           => $validated['name'],
    'email'          => $validated['email'],
    'phone'          => $validated['phone'],
    'address'        => $validated['address'],
    'payment_method' => $validated['payment_method'],
    'total'          => $total,
    'items'          => $cart
];

// ✅ Send email
// Mail::to($orderData['email'])->send(new OrderPlacedMail($orderData));
Mail::to($orderData['email'])->send(new OrderPlacedMail($orderData));


     // Clear cart
    session()->forget('cart');

     // Redirect to confirmation page
    return redirect('user/dashboard/orders')->with('success', 'Order placed successfully!');


    }
}
