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

        $testimonials = Testimonial::approved()->sorted()->take(9)->get();

        $combosTradicional = $combos->where('size', 'tradicional');
        $combosBocado = $combos->where('size', 'bocado');
        $combosAdiciones = $combos->where('size', 'adiciones');
        $combosSinSize = $combos->whereNull('size');

        return view('pages.home', compact(
            'featuredCombos',
            'combos',
            'combosTradicional',
            'combosBocado',
            'combosAdiciones',
            'combosSinSize',
            'testimonials'
        ));
    }


}
