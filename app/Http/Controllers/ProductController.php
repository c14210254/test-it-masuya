<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $request->validate([
            'kode_produk' => [
                'required',
                'unique:products,kode_produk',
                'regex:/^[a-zA-Z0-9]+$/',
            ],
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ], [
        'kode_produk.required' => 'Kode produk wajib diisi.',
        'kode_produk.unique' => 'Kode produk sudah digunakan, silakan gunakan kode lain.',
        'kode_produk.regex' => 'Kode produk hanya boleh berisi huruf dan angka (tanpa spasi atau simbol).',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product){
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product){
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(Product $product){
        if ($product->transactionDetails()->count() > 0) {
            return redirect()->route('products.index')
                ->with('error', 'Produk tidak bisa dihapus karena sudah ada transaksi!');
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }

}
