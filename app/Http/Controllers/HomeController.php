<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    private const CACHE_KEY = 'bocaditos.homepage';
    private const CACHE_SITEMAP_KEY = 'bocaditos.sitemap.lastmod';
    private const CACHE_TTL = 3600; // 1 hora

    public function index()
    {
        try {
            $data = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
                $featuredCombos = Combo::active()
                    ->featured()
                    ->sorted()
                    ->get();

                $combos = Combo::active()
                    ->sorted()
                    ->get();

                $testimonials = Testimonial::approved()->sorted()->take(9)->get();

                return compact('featuredCombos', 'combos', 'testimonials');
            });

            $featuredCombos = $data['featuredCombos'];
            $combos = $data['combos'];
            $testimonials = $data['testimonials'];
        } catch (\Throwable $e) {
            logger()->error('Error al cargar la página principal: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            $featuredCombos = collect();
            $combos = collect();
            $testimonials = collect();
        }

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

    /**
     * Invalida la caché de la homepage.
     * Se llama desde los observers cuando hay cambios en combos o testimonios.
     */
    public static function flushCache(): void
    {
        Cache::forget(self::CACHE_KEY);
        Cache::forget(self::CACHE_SITEMAP_KEY);
    }
}
