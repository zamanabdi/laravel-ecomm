<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
Route::post('login-request', [LoginController::class, 'handleLogin'])->middleware('role.redirect');

// Dashboards (no role middleware here; we’re redirecting right after login)
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/user/dashboard', function () {
    return view('customer.dashboard');
});


Route::get('logout', function () {
    session()->forget('customer');
    return redirect('login-form')->with('success', 'Logged out');
});
