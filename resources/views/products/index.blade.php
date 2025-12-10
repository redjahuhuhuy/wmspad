<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Warehouse Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet">

    {{-- Font Awesome --}}
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        footer {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <!--- HEADER --->
    <header class="bg-dark text-white text-center py-4 mb-4 shadow">
        <h1 class="fw-bold">Warehouse Management System</h1>
    </header>

    <div class="container mt-4">

        {{-- Alert sukses --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error validasi --}}
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

        <!--- KPI --->
        <h3 class="mb-3 fw-bold">Dashboard Overview</h3>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="card text-bg-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fa-solid fa-warehouse me-2"></i>Inbound Today
                        </h5>
                        <p class="card-text fs-3 fw-bold">{{ $inboundToday ?? 0 }} Items</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-bg-success shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fa-solid fa-truck me-2"></i>Outbound Today
                        </h5>
                        <p class="card-text fs-3 fw-bold">{{ $outboundToday ?? 0 }} Items</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-bg-warning shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fa-solid fa-boxes-stacked me-2"></i>Total Stock
                        </h5>
                        <p class="card-text fs-3 fw-bold">{{ $totalStock ?? 0 }} Items</p>
                    </div>
                </div>
            </div>
        </div>

        <!--- TABLE PRODUCT --->
        <div class="card shadow mb-4 mt-4">
            <div class="card-header bg-dark text-white text-center fw-bold">
                Product Inventory
            </div>

            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Stock Quantity</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->product_code }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->stock_quantity }}</td>
                                <td class="text-center">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="btn btn-sm btn-warning me-2">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    {{-- Tombol Delete --}}
                                    <form action="{{ route('products.destroy', $product->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin hapus product ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-3">
                                    Belum ada product.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!--- ADD NEW PRODUCT --->
        <div class="card shadow mb-5">
            <div class="card-header bg-primary text-white fw-bold">
                Add New Product
            </div>

            <div class="card-body">
                <form class="row g-3" method="POST" action="{{ route('products.store') }}">
                    @csrf

                    <div class="col-md-4">
                        <label class="form-label">Product Code</label>
                        <input type="text"
                               class="form-control"
                               name="product_code"
                               value="{{ old('product_code') }}"
                               required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Product Name</label>
                        <input type="text"
                               class="form-control"
                               name="product_name"
                               value="{{ old('product_name') }}"
                               required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Product Quantity</label>
                        <input type="number"
                               class="form-control"
                               name="stock_quantity"
                               value="{{ old('stock_quantity') }}"
                               required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-4">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--- FOOTER --->
    <footer class="bg-dark text-light text-center py-4 mt-5">
        <p class="mb-0 fs-5 fw-bold">Warehouse Management System</p>
        <small class="text-secondary">Developed by Muhammad Redjarizky Putramarwan</small>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
