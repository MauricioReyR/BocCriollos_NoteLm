<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCombos = Combo::active()
            ->featured()
            ->sorted()
            ->get();

        $combos = Combo::active()
            ->sorted()
            ->where('is_featured', false)
            ->get();

        $testimonials = Testimonial::approved()->sorted()->get();

        $combosTradicional = $combos->where('size', 'tradicional');
        $combosBocado = $combos->where('size', 'bocado');
        $combosSinSize = $combos->whereNull('size');

        return view('pages.home', compact(
            'featuredCombos',
            'combos',
            'combosTradicional',
            'combosBocado',
            'combosSinSize',
            'testimonials'
        ));
    }


}
