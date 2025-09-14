@extends('layout')

@section('title', 'Edit Product')

@section('content')
<style>
    .edit-container {
        max-width: 700px;
        margin: 50px auto;
        background: #fff;
        border-radius: 14px;
        padding: 30px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
    }

    .edit-container h2 {
        text-align: center;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 25px;
        color: #222;
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 8px;
        padding: 10px;
        font-size: 1rem;
        margin-bottom: 18px;
    }

    .btn-save {
        background: #007bff;
        border: none;
        padding: 12px 22px;
        border-radius: 6px;
        color: #fff;
        font-weight: 600;
        font-size: 1rem;
        transition: background 0.3s;
        width: 100%;
    }

    .btn-save:hover {
        background: #0056b3;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        font-size: 0.95rem;
        color: #555;
        text-decoration: none;
    }

    .back-link:hover {
        color: #007bff;
    }
</style>



<div class="edit-container">
    <h2>Edit Product</h2>

    <form action="/editproductfinal" method="POST">
        @csrf
        @method('PUT')


        <input type="hidden" name="edit_product_id" value="{{$product->id}}">

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Product Title</label>
            <input type="text" class="form-control" id="title" name="title" 
                   value="{{ old('title', $product->title) }}" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Product Description</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Image URL -->
        <div class="mb-3">
            <label for="img_url" class="form-label">Image URL</label>
            <input type="url" class="form-control" id="img_url" name="img_url" 
                   value="{{ old('img_url', $product->img_url) }}" required>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price (₹)</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01"
                   value="{{ old('price', $product->price) }}" required>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-save">💾 Save Changes</button>
    </form>

    <a href="#" class="back-link">⬅ Back to Products</a>
</div>
@endsection
