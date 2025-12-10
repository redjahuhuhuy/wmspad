<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        //KPI
        $totalStock = Product::sum('stock_quantity');
        $inboundToday = 100;
        $outboundToday = 45;

        return view('products.index', compact(
            'products',
            'totalStock',
            'inboundToday',
            'outboundToday'
        ));
    }

    // CREATE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_code' => 'required|unique:products,product_code',
            'product_name' => 'required',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product berhasil ditambahkan.');
    }

    // READ
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // UPDATE
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_code' => 'required|unique:products,product_code,' . $product->id,
            'product_name' => 'required',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product berhasil diupdate.');
    }

    // DELETE
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product berhasil dihapus.');
    }
}
