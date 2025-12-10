<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - Warehouse Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h3 class="mb-4 fw-bold">Edit Product</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Terjadi kesalahan:
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}"
          method="POST"
          class="card p-4 shadow-sm bg-white">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Product Code</label>
            <input type="text"
                   class="form-control"
                   name="product_code"
                   value="{{ old('product_code', $product->product_code) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text"
                   class="form-control"
                   name="product_name"
                   value="{{ old('product_name', $product->product_name) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Product Quantity</label>
            <input type="number"
                   class="form-control"
                   name="stock_quantity"
                   value="{{ old('stock_quantity', $product->stock_quantity) }}"
                   required>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('products.index') }}"
            class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-rotate"></i> Update Product
        </button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
