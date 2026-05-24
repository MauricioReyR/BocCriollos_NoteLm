<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with(['category', 'sizes'])
            ->featured()
            ->active()
            ->sorted()
            ->get();

        $categories = Category::active()
            ->sorted()
            ->withCount('products')
            ->get();

        $combos = Product::whereHas('category', function ($q) {
                $q->where('slug', 'combos');
            })
            ->active()
            ->sorted()
            ->with(['category', 'sizes'])
            ->get();

        return view('pages.home', compact('featuredProducts', 'categories', 'combos'));
    }
}
