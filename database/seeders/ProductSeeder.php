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
        Product::create([
            'name' => 'Vestido Floral',
            'price' => 129.90,
            'image' => 'https://via.placeholder.com/300x400'
        ]);

        Product::create([
            'name' => 'Blusa Feminina',
            'price' => 79.90,
            'image' => 'https://via.placeholder.com/300x400'
        ]);

        Product::create([
            'name' => 'Calça Jeans',
            'price' => 159.90,
            'image' => 'https://via.placeholder.com/300x400'
        ]);
    }
}
