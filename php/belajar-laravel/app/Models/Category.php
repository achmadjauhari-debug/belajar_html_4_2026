<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'icon', 'sort_order'];
    public function products(){
        return $this->hasMany(Product::class); //relasi one to many, satu kategori bisa memiliki banyak produk
    }
}
