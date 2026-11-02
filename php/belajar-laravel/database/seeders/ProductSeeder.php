<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = 
        [
            [
                'category_id' => 1,
                'image' => 'product1.jpg',
                'name' => 'Digital Printing Product 1',
                'stock' => 10,
                'price' => 10000,
            ],
            [
                'category_id' => 2,
                'image' => 'product2.jpg',
                'name' => 'Name Card Product 1',
                'stock' => 20,
                'price' => 20000,
            ],
            [
                'category_id' => 3,
                'image' => 'product3.jpg',
                'name' => 'Sticker Product 1',
                'stock' => 30,
                'price' => 30000,
            ],
        ];
        foreach($products as $value) 
        {
            Product::updateOrCreate([
                'category_id' => $value['category_id'],
                'image' => $value['image'],
                'name' => $value['name'],
                'stock' => $value['stock'],
                'price' => $value['price'],
                ]);
        }
    }
}
