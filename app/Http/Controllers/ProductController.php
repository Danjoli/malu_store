<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Products', [
            'products' => Product::all()
        ]);
    }

    public function show($id)
    {
        return Inertia::render('ProductShow', [
            'product' => Product::findOrFail($id)
        ]);
    }
}
