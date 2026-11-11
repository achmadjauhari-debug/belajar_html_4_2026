<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\CategoryBlog;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Management Blog || PPKD Sticker";
        // Menggunakan eager loading 'category' agar query lebih optimal
        $blogs = Blog::with('category')->orderBy('id', 'desc')->get(); 
        //1 kategori bisa memiliki banyak produk, jadi kita panggil relasi category dengan method with('category') untuk menampilkan data kategori pada tabel produk
        // $products = Category::with('products')->count(); 
        // //count menghitung jumlah produk per kategori, karena relasi one to many, jadi kita panggil relasi products dengan method with('products') untuk menghitung jumlah produk per kategori
        return view('admin.blog.index', compact('title', 'blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Blog";
        $categories = CategoryBlog::all();
        return view('admin.blog.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =    $request->validate([
            'name'  => 'required|string|max:60',
            'blog_category_id' => 'required|exists:category_blogs,id',
            'brief_description' => 'required|string',
            'slug'  => 'nullable|string|max:60|unique:blogs,slug',
            'content' => 'required|string',
            'author' => 'nullable|string',
            'cover_path' => 'nullable|image|mimes:png,jpeg,webp|max:2048',
            
        ]);

        if($request->hasFile('cover_path')) {
            $validated['cover_path'] = $request->file('cover_path')->store('blogs', 'public');
        }
        
        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        Blog::create($validated);

        return redirect()->route('admin.blog.index')
        -> with('success', 'Blog berhasil di tambahkan');
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
   

    public function edit(Blog $blog)
    {
        $title = 'Ubah Blog || PPKD Sticker';
        // PERBAIKAN: Ambil daftar kategori agar dropdown di halaman edit berfungsi
        $categories = CategoryBlog::orderBy('id')->get();
        return view('admin.blog.edit', compact('blog','title','categories'));
    }

    

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Blog $blog)
    {
        // Normalize first, so the unique check compares the same format that is stored.
        // If the slug input is empty, fall back to the product name.
        $validated =    $request->validate([
            'name'  => 'required|string|max:60',
            'blog_category_id' => 'required|exists:category_blogs,id',
            'brief_description' => 'required|string',
            'slug'  => 'nullable|string|max:60|unique:category_blogs,slug',
            'content' => 'required|string',
            'author' => 'nullable|string',
            'cover_path' => 'image|mimes:png,jpeg,webp|max:2048',
            
        ]);

        if ($request->hasFile('cover_path')) {
            // ada gak gambar di table blogs
        if ($blog->cover_path) {    
        Storage::disk('public')->delete($blog->cover_path);
        }
        $validated['cover_path'] = $request->file('cover_path')->store('blogs','public');
        }

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        $blog->update($validated);
        
        return redirect()->route('admin.blog.index')->with('success', 'Produk berhasil diperbarui');
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);

        if($blog->cover_path) {
            Storage::disk('public')->delete($blog->cover_path);
        }
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog berhasil dihapus');
    }
}
