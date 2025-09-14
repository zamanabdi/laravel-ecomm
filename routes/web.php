<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('home');
});

// signup routes here...
Route::view('signup-form','signup');

// registering a new customer
Route::post('create-new-customer',[CustomerController::class,'createCustomer']);


// login routes here...
Route::get('login-form',function(){
    return view('login');
});

// Apply the role-redirect middleware to the login POST
Route::post('login-request', [LoginController::class, 'handleLogin']);

// Dashboards (no role middleware here; we’re redirecting right after login)
Route::get('/admin/dashboard',[DashboardController::class,'displayAdmin']);

Route::get('/user/dashboard',[DashboardController::class,'displayUserDashboard']);


Route::get('logout', function () {
    session()->forget('customer');
    return redirect('login-form')->with('success', 'Logged out');
});



// Admin Functionality

// manage products

Route::get('admin/manage_products',[ProductController::class,'fetchAllProducts']);


// add new product
Route::post('admin/addnewproduct',[ProductController::class,'addNewProduct']);

//All Products
Route::get('all_products',[ProductController::class,'getAllProducts']);

// single product page
Route::get('product',[ProductController::class,'displaySingleProduct']);

// edit single product -> by Admin
Route::get('admin/editproduct',[ProductController::class,'editProductForm']);

// edit product final
Route::put('editproductfinal',[ProductController::class,'editProductFinal']);



// delete product confirmation page
Route::get('admin/deleteproduct',[ProductController::class,'confirmProductDelete']);




// Manage Customers
Route::get('admin/manage_customers',[CustomerController::class,'fetchAllCustomers']);


// Deleting a customer - by admin
Route::get('admin/deletecustomer',[CustomerController::class,'confirmDelete']);

Route::delete('admin/deletecustomerfinal',[CustomerController::class,'handleDeleteAction']);

Route::post('admin/addnewcustomer',[CustomerController::class,'addNewCustomer']);


// edit Customer
Route::get('admin/editcustomer',[CustomerController::class,'displayEditForm']);

Route::put('admin/updatecustomer',[CustomerController::class,'editCustomer']);

//Manage Orders
Route::get('admin/manage_orders',function(){

    return view('admin.manage-orders');
});


// User Dashboard Routes
Route::get('user/dashboard/editmyprofile',[CustomerController::class,'displayEditProfile']);

// display order history page
Route::get('user/dashboard/orders',[OrderController::class,'displayOrderHistory'])->middleware('customer.auth');


Route::put('user/dashboard/updateprofile',[CustomerController::class,'handleProfileUpdate']);


// Show Cart page
Route::get('/cart',[CartController::class,'show'])->name('cart.show');

// Add product To Cart
Route::post('/cart/add',[CartController::class,'add'])->name('cart.add');



//Update Quantity for an item already in cart
Route::post('/cart/update',[CartController::class,'update'])->name('cart.update');

// Remove single item from cart
Route::post('/cart/remove',[CartController::class,'remove'])->name('cart.remove');

// clear entire cart
Route::post('/cart/clear',[CartController::class,'clear'])->name('cart.clear');

// Display checkout page
Route::get('/checkout',[CheckoutController::class,'index'])->middleware('customer.auth')->name('checkout.index');


// Place order
Route::post('/checkout/place-order',[CheckoutController::class,'placeOrder'])->name('checkout.placeOrder');


// View order confirmation page
Route::get('/orders/{id}',[OrderController::class,'show'])->middleware('customer.auth');

// Admin orders page
Route::get('/admin/orders',[OrdersController::class,'index'])->name('admin.orders');

//Update order status
Route::post('/admin/orders/update/{id}',[OrdersController::class,'update'])->name('admin.orders.update');

// Cancel Order by The user
Route::patch('/orders/cancel/{id}', [OrderController::class, 'cancel'])->name('orders.cancel');

// test mail
Route::get('/test-mail', function () {
    Mail::raw('This is a test email from Laravel using Gmail SMTP.', function ($message) {
        $message->to('zaman.abdi24@gmail.com')
                ->subject('Test Email');
    });

    return 'Test email sent!';
});
