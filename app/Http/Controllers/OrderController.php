<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function displayOrderHistory(Request $req){
        $customer = $req->session()->get('customer');
        $customer_id = $customer['id'];

        $orders = DB::table('orders')->where('customer_id',$customer_id)->orderBy('created_at','desc')->get();


        return view('customer.order-history',compact('orders'));
    }


    public function show(Request $req, $id){

        $customer = $req->session()->get('customer');
        $customer_id = $customer['id'];

        $order = DB::table('orders')->where('id',$id)->where('customer_id',$customer_id)->first();

        $order_id = $order->id;

        if (!$order) {
        abort(404, 'Order not found');
    }


    // Fetch the order items
    $items = DB::table('order_items')->where('order_id',$order_id)->get();


    return view('customer.show-order',compact('order','items'));
    }



    public function cancel($id)
{
    DB::table('orders')
        ->where('id', $id)
        ->where('status', 'pending') // only pending can be cancelled
        ->update([
            'status' => 'cancelled', 
            'updated_at' => now()
        ]);

    return redirect()->back()->with('success', 'Order has been cancelled.');
}



}
