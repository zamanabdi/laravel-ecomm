<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
     /**
     * Show the cart page.
     */
    public function show(Request $request){
      
        $cart = $request->session()->get('cart',[]);

        $total = 0;
        foreach($cart as $item){
         $total = $item['price'] * $item['quantity'];
        }


        return view('cart',['cart'=>$cart,
                           'total'=>$total
                        ]);
    }



    /**
     * Add a product to cart (or increase qty if it already exists).
     */
    public function add(Request $request){
     
        // 10: Validate incoming data: product_id required and integer; quantity optional (if present must be >= 1)
        $validated = $request->validate([
            'product_id'=>'required | integer',
            'quantity'=>'nullable|integer|min:1',
            'size'=>'nullable',
        ]);

        // 11: Try to find the product in DB (use find to handle not found gracefully)
        $product = Product::find($validated['product_id']);

        // 12: If no product found, redirect back with an error message
        if(!$product){
            return redirect()->back()->with('error','Product not found');
        }

        // 13: Determine quantity (if not provided default to 1)
        $qty = $validated['quantity'] ?? 1;


        // 14: Get current cart (associative array keyed by product id) from session
        $cart = $request->session()->get('cart',[]);

        // 15: If product already in cart, increment quantity and update subtotal
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $qty; // 15a: increment existing quantity
            $cart[$product->id]['subtotal'] = $cart[$product->id]['price'] * $cart[$product->id]['quantity']; // 15b: refresh subtotal
        } else {
            // 16: If product not in cart, add full entry
            $cart[$product->id] = [
                'id'        => $product->id,               // product id
                'title'     => $product->title,           // product title
                'price'     => (float) $product->price,   // price as float
                'quantity'  => $qty,                      // requested quantity
                'img_url'   => $product->img_url ?? null, // optional image url
                'subtotal'  => (float) $product->price * $qty, // computed subtotal
                'size'      => $validated['size'] ?? null
            ];
        }

        // 17: Save updated cart back to session
        $request->session()->put('cart', $cart);

        // 18: Redirect back (usually product page) with success message
        return redirect()->back()->with('success', 'Product added to cart.');
    }


    /**
     * Update quantity for a cart item.
     */
    public function update(Request $request) // 19: update() handles quantity updates
    {
        // 20: Validate inputs, product_id required and quantity required and >= 1
        $validated = $request->validate([
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|min:1',
        ]);

        // 21: Retrieve cart from session
        $cart = $request->session()->get('cart', []);

        // 22: If item exists in cart, update it
        if (isset($cart[$validated['product_id']])) {
            $cart[$validated['product_id']]['quantity'] = $validated['quantity']; // 22a: set new quantity
            $cart[$validated['product_id']]['subtotal'] = $cart[$validated['product_id']]['price'] * $validated['quantity']; // 22b: update subtotal
            $request->session()->put('cart', $cart); // 22c: save back to session
            return redirect()->route('cart.show')->with('success', 'Cart updated.');
        }

        // 23: If item not found, redirect with error
        return redirect()->route('cart.show')->with('error', 'Item not found in cart.');
    }

    /**
     * Remove a single item from the cart.
     */
    public function remove(Request $request) // 24: remove() handles removing an item
    {
        // 25: Validate product_id
        $validated = $request->validate([
            'product_id' => 'required|integer',
        ]);

        // 26: Get cart
        $cart = $request->session()->get('cart', []);

        // 27: If item exists, unset it and save session
        if (isset($cart[$validated['product_id']])) {
            unset($cart[$validated['product_id']]); // 27a: remove the array key for that product
            $request->session()->put('cart', $cart); // 27b: save updated cart
            return redirect()->route('cart.show')->with('success', 'Item removed from cart.');
        }

        // 28: If it wasn't in cart
        return redirect()->route('cart.show')->with('error', 'Item not found in cart.');
    }

    /**
     * Clear the entire cart.
     */
    public function clear(Request $request) // 29: clear() removes the entire 'cart' session key
    {
        $request->session()->forget('cart'); // 30: forget removes that key from session entirely
        return redirect()->route('cart.show')->with('success', 'Cart cleared.');
    }




}
