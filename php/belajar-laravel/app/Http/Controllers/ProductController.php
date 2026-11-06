<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $validated =    $request->validate([
            'category_id' => 'required|exists:categories,id',
            // 'image' => 'nullable|image|mimes:png,jpg,jpeg,gif', 
            'name'  => 'required|string|max:60',
            'slug'  => 'nullable|string|max:60|unique:products,slug',
            'price' => 'nullable|numeric',
            'price_art_cartoon' => 'nullable|numeric',
            'price_art_paper' => 'nullable|numeric',
            'price_hvs' => 'nullable|numeric',
            'price_doft' => 'nullable|numeric',
            'price_glossy' => 'nullable|numeric',
            'price_cutting' => 'nullable|numeric',
            'price_no_cutting' => 'nullable|numeric',
            'brief_description' => 'nullable|string',
            'description' => 'nullable|string',

            //validasi produk image
            'images'    => 'nullable|array',
            'images.*'  => 'image|mimes:png,jpg,jpeg,gif,webp|max:2048', // Validasi setiap gambar dalam array
            'alt'       => 'nullable|array',
            'alt.*'     => 'nullable|string|max:255', // Validasi setiap alt text dalam array
            'sort_order' => 'nullable|array',
            
        ]);
        
        //ada 2 tabel product dan product_images, jadi kita harus menyimpan data ke tabel product terlebih dahulu, baru kemudian menyimpan data ke tabel product_images
        //transaction untuk menyimpan data ke tabel product dan product_images sekaligus, jika salah satu gagal maka semua akan dibatalkan
        DB::transaction(function() use ($request, $validated) {
           
            $product = Product::create([
                'category_id'   => $validated['category_id'],             
                'name'          => $validated['name'],
                'price'         => $validated['price'],
                'sort_order' => $validated['sort_order'] ?? 0,
                'image' => null, // Inisialisasi image utama sebagai null, akan diupdate nanti jika ada gambar
                'slug'          => Str::slug($validated['name']),
                'brief_description' => $validated['brief_description'] ?? null,
                'description' => $validated['description'] ?? null, 
                'price_art_cartoon' => $validated['price_art_cartoon'] ?? null,
                'price_art_paper' => $validated['price_art_paper'] ?? null,
                'price_hvs' => $validated['price_hvs'] ?? null,
                'price_doft' => $validated['price_doft'] ?? null,
                'price_glossy' => $validated['price_glossy'] ?? null,
                'price_cutting' => $validated['price_cutting'] ?? null,
                'price_no_cutting' => $validated['price_no_cutting'] ?? null,
                
                
            ]);

              if ($request->hasFile('images')) 
            {
                $imageData=[];
                $imagePath = $path;

                foreach ($request->file('images') as $key => $file) {
                    $path = $file->store('products', 'public');
                    if ($key === 0) {
                        $firstImageData = $path; // Simpan path gambar pertama
                    }
               

                    $imageData[] = [
                        'path' => $path,
                        'alt' => $request->input('alt.{key}') ?? $product->name,
                        'sort_order' => $key + 1, // Default sort order berdasarkan urutan upload
                    ];
                }
                $product->images()->createMany($imageData);
                if ($imagePath) {
                    $product->update(['image' => $imagePath]); // Update gambar utama produk dengan gambar pertama
                  
                }
            }
    }); 
            return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan');
    


        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        } // <--- KURUNG PENUTUP UNTUK IF SUDAH DITAMBAHKAN

        Product::create([
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'price' => $validated['price'],
            'price_art_cartoon' => $validated['price_art_cartoon'],
            'price_art_paper' => $validated['price_art_paper'],
            'price_hvs' => $validated['price_hvs'],
            'price_doft' => $validated['price_doft'],
            'price_glossy' => $validated['price_glossy'],
            'price_cutting' => $validated['price_cutting'],
            'price_no_cutting' => $validated['price_no_cutting'],
            'brief_description' => $validated['brief_description'],
            'description' => $validated['description'],
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
        // Normalize first, so the unique check compares the same format that is stored.
        // If the slug input is empty, fall back to the product name.
        $request->merge([
        'slug' => Str::slug($request->input('slug') ?: $request->input('name')),
    ]);
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048',
            'name'  => 'required|string|max:60',
            'slug'  => ['nullable', 'string', 'max:60', Rule::unique('products', 'slug')->ignore($product->id)],
            'price' => 'nullable|numeric',
            'price_art_cartoon' => $validated['price_art_cartoon'] ?? null,
            'price_art_paper' => $validated['price_art_paper'] ?? null,
            'price_hvs' => $validated['price_hvs'] ?? null,
            'price_doft' => $validated['price_doft'] ?? null,
            'price_glossy' => $validated['price_glossy'] ?? null,
            'price_cutting' => $validated['price_cutting'] ?? null,
            'price_no_cutting' => $validated['price_no_cutting'] ?? null,
            'brief_description' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $imagePath = $product->image; // Tetap gunakan gambar lama jika tidak ada yang diunggah
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
            'name'  => $validated['name'],
            'slug'  => $validated['slug'],
            'price' => $validated['price'],
            'price_art_cartoon' => $validated['price_art_cartoon'] ?? null,
            'price_art_paper' => $validated['price_art_paper'] ?? null,
            'price_hvs' => $validated['price_hvs'] ?? null,
            'price_doft' => $validated['price_doft'] ?? null,
            'price_glossy' => $validated['price_glossy'] ?? null,
            'price_cutting' => $validated['price_cutting'] ?? null,
            'price_no_cutting' => $validated['price_no_cutting'] ?? null,
            'brief_description' => $validated['brief_description'],
            'description' => $validated['description'],
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
