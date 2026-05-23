<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->featured()
            ->active()
            ->sorted()
            ->get();

        $categories = Category::active()
            ->sorted()
            ->withCount('products')
            ->get();

        return view('pages.home', compact('featuredProducts', 'categories'));
    }
}
