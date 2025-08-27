<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function handleLogin(Request $req)
    {
        // Validate basic inputs (optional but recommended)
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $customer = Customer::where('email', $req->email)->first();

        if (!$customer || !Hash::check($req->password, $customer->password)) {
            return back()->with('error', 'Invalid email or password');
        }

        // Save minimal info in session
        $req->session()->put('customer', [
            'id'    => $customer->id,
            'name'  => $customer->username,
            'email' => $customer->email,
            'role'  => $customer->role,   // 'admin' or 'user'
        ]);

        // Return anything — middleware will intercept and redirect by role
        return redirect('/'); // neutral redirect; will be overridden by middleware
    }
}
