<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Management Produk";
        // Menggunakan eager loading 'category' agar query lebih optimal
        $products = Product::with('category')->orderBy('id', 'desc')->get(); 
        return view('admin.product.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Produk";
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.product.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:60',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048', 
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } // <--- KURUNG PENUTUP UNTUK IF SUDAH DITAMBAHKAN

        Product::create([
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);
        
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan');
    } // <--- KURUNG PENUTUP UNTUK FUNGSI STORE SUDAH DITAMBAHKAN

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
