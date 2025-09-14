<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    // List all orders
    public function index()
    {
        $orders = DB::table('orders')->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Update order status
    public function update(Request $request, $id)
    {
        DB::table('orders')
            ->where('id', $id)
            ->update([
                'status' => $request->status,
                'updated_at' => now(),
            ]);

        return redirect()->route('admin.orders')->with('success', 'Order status updated successfully!');
    }
}
