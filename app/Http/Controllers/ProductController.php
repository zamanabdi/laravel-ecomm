<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function addNewProduct(Request $req){

         Product::create([
            'title'=>$req->title,
            'description'=>$req->description,
            'category'=>$req->category,
            'img_url'=>$req->img_url,
            'price'=>$req->price
         ]);

        return redirect('admin/manage_products')->with('success','New Product added successfully');
    }


    // display all products
    public function getAllProducts(){

        $products = Product::all();

        return view('all-products',['data'=>$products]);

    }


    // manage all products
    public function fetchAllProducts(){
        $products = Product::all();

        return view('admin.manage-products',['data'=>$products]);
    }


    public function displaySingleProduct(Request $req){
        $currId = $req->query('product_id');

        $product = Product::findOrFail($currId);

        return view('single-product-page', compact('product'));

    }


   public function editProductForm(Request $req){
     $currId = $req->query('edit_product_id');

     $product = Product::findOrFail($currId);

     return view('edit-product-page',['product'=>$product]);
   }


   public function editProductFinal(Request $req){
    $currId = $req->edit_product_id;

    $product = Product::findOrFail($currId);

    $product->title = $req->title;
    $product->description = $req->description;
    $product->img_url = $req->img_url;
    $product->price = $req->price;

    $product->save();

    return redirect('admin/manage_products')->with('success','Product updated successfully');
   }


   //confirm product delete
   public function confirmProductDelete(Request $req){
     $currId = $req->query('delete_product_id');

     Product::destroy($currId);

     return redirect('admin/manage_products');
   }
}
