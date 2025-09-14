@extends('layout')

@section('title','Manage Products')

@section('content')

<style>
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: linear-gradient(135deg, #667eea, #764ba2);
        margin: 0;
        padding: 0;
        color: #fff;
    }


    .manage-products-wrapper{
        height: 1200px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-top: 35px;
        flex-direction: column;
    }
</style>

<div class="manage-products-wrapper">
    <h1>Add New Product</h1>

    @if(request()->has('create-new-product'))

    <div style="box-shadow:3px 5px 8px 5px rgba(0,0,0,0.2); width:700px; margin-top:20px; padding:15px; border-radius:10px;">


<form method="POST" action="addnewproduct">
@csrf

  <div class="mb-3">
    <label for="category" class="form-label">Category</label>
    <select class="form-control" name="category" id="category">
        <option value="">--Choose Category--</option>
        <option value="smart_tvs">Smart TVs</option>
        <option value="smart_watches">Smart Watches</option>
        <option value="sports_shoes">Sports Shoes</option>
        <option value="laptops">Laptops</option>
        <option value="gaming_consoles">Gaming Consoles</option>
        <option value="earbuds">Earbuds</option>
        <option value="mens_wear">Mens Wear</option>
        <option value="kids_wear">Kids Wear</option>
        <option value="womens_wear">Womens Wear</option>
    </select>
  </div>

  <!-- title -->
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" name="title" class="form-control" id="title" placeholder="Enter the Title here...">
  </div>

  <!-- description -->
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <input type="text" class="form-control" id="description" name="description" placeholder="Enter the Description here...">
  </div>

  <!-- Image link -->
   <div class="mb-3">
    <label for="img_url" class="form-label">Image Link</label>
    <input type="text" class="form-control" id="img_url" name="img_url" placeholder="Paste the image link here...">
  </div>

  <!-- Price -->
   <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input type="text" class="form-control" id="price" name="price" placeholder="Enter the Product's Price in rupees here...">
  </div>


  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    </div>

    @elseif(Request::is('admin/manage_products'))
 
    <div style="border-radius:8px; box-shadow: 2px 3px 10px 5px rgba(0,0,0,0.2); margin-top:35px; width:1200px; padding:15px;">
        <button class="btn btn-warning">
            <a style="color:inherit; text-decoration:none;" href="?create-new-product">Add New Product</a>
        </button>
        <hr>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Image Link</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>


  @foreach($data as $product)
    <tr>
      <th scope="row">{{$product->id}}</th>
      <td>{{$product->title}}</td>
      <td>{{$product->description}}</td>
      <td>{{$product->img_url}}</td>
      <td>&#8377;{{$product->price}}</td>
      <td style="display: flex; flex-direction:column; justify-content:space-between;gap:5px;">
        <button class="btn btn-warning">
          <a style="text-decoration: none; color:inherit;" href="editproduct?edit_product_id={{$product->id}}">Edit</a>
        </button>
        <button class="btn btn-danger">
          <a style="text-decoration: none; color:inherit;" href="deleteproduct?delete_product_id={{$product->id}}">Delete</a>
        </button>
      </td>
    </tr>

    @endforeach

    
  </tbody>
</table>
    </div>


   

    @endif
</div>


@endsection


