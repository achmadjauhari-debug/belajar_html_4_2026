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
        $title = "Management Produk || PPKD Sticker";
        // Menggunakan eager loading 'category' agar query lebih optimal
        $products = Product::with('category')->orderBy('id', 'desc')->get(); 
        //1 kategori bisa memiliki banyak produk, jadi kita panggil relasi category dengan method with('category') untuk menampilkan data kategori pada tabel produk
        // $products = Category::with('products')->count(); 
        // //count menghitung jumlah produk per kategori, karena relasi one to many, jadi kita panggil relasi products dengan method with('products') untuk menghitung jumlah produk per kategori
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
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048', 
            'name'  => 'required|string|max:60',
            'slug'  => 'nullable|string|max:60|unique:products,slug',
            'price' => 'required|numeric',
            'price_art_cartoon' => 'nullable|numeric',
            'price_art_paper' => 'nullable|numeric',
            'price_hvs' => 'nullable|numeric',
            'price_doft' => 'nullable|numeric',
            'price_glossy' => 'nullable|numeric',
            'price_cutting' => 'nullable|numeric',
            'price_no_cutting' => 'nullable|numeric',
            'brief_description' => 'nullable|string',
            'description' => 'nullable|string',
        ]);
        
        $validated['slug'] = Str::slug($validated['slug']) ?? $validated['name'];
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } // <--- KURUNG PENUTUP UNTUK IF SUDAH DITAMBAHKAN

        Product::create([
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'name' => $request->name,
            'slug' => $request->slug,
            'brief_description' => $request->brief_description,
            'description' => $request->description,
            'price' => $request->price,
            'price_art_cartoon' => $request->price_art_cartoon,
            'price_art_paper' => $request->price_art_paper,
            'price_hvs' => $request->price_hvs,
            'price_doft' => $request->price_doft,
            'price_glossy' => $request->price_glossy,
            'price_cutting' => $request->price_cutting,
            'price_no_cutting' => $request->price_no_cutting,
        ]);
        
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan');
    } 

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
   

    public function edit(Product $product)
    {
        $title = 'Edit Produk || PPKD Sticker';
        // PERBAIKAN: Ambil daftar kategori agar dropdown di halaman edit berfungsi
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.product.edit', compact('product','title','categories'));
    }

    

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'  => 'required|string|max:60',
            'slug'  => 'nullable|string|max:60|unique:products,slug',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'brief_description' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $imagePath = $product->image; // Tetap gunakan gambar lama jika tidak ada yang diunggah
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'name'  => $request->name,
            'slug'  => $request->slug,
            'price' => $request->price,
            'brief_description' => $request->brief_description,
            'description' => $request->description,
        ]);
        
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil dihapus');
    }
}
