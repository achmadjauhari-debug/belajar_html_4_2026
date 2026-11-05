<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CatalogController extends Controller
{
    public function category( string $slug )
    {
        // slug digital-printing id ke berapa
        $category = Category::where('slug', $slug)->firstOrFail();

        // $products = Product::where('category_id', $category->id)->get();
        $products = $category->products()->paginate(4);
        return view('category.index', compact('products', 'category'));
    }

    public function product(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('product.show', compact('product'));
    }
}
