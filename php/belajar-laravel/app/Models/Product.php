<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'image', 'name', 'stock', 'price'];

    //many to one relationship
    public function category(){
        return $this->belongsTo(Category::class); //$this mengacu ke kelas product, belongsTo mengacu ke kelas category
        //setelah itu masuk ke ProductController.php, di method index() kita panggil relasi category dengan method with('category') untuk menampilkan data kategori pada tabel produk
        //setelah itu masuk ke resources/views/admin/product/index.blade.php, kita panggil relasi category dengan $item->category->name untuk menampilkan nama kategori pada tabel produk
        
    }
}
