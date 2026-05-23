<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear categorías principales
        $categories = [
            ['name' => 'Empanadas Tradicionales y Bocado', 'slug' => 'empanadas', 'icon' => '🥟', 'gradient' => 'from-burnt-red-600 to-burnt-red-800', 'sort_order' => 1],
            ['name' => 'Pasteles de Yuca tipo Bocado', 'slug' => 'pasteles', 'icon' => '🥐', 'gradient' => 'from-warm-orange-600 to-warm-orange-800', 'sort_order' => 2],
            ['name' => 'Hamburguesas', 'slug' => 'hamburguesas', 'icon' => '🍔', 'gradient' => 'from-burnt-red-700 to-burnt-red-900', 'sort_order' => 3],
            ['name' => 'Arepas Trifasicas Tradicionales y Tipo Bocado', 'slug' => 'arepas', 'icon' => '🍘', 'gradient' => 'from-warm-orange-700 to-orange-900', 'sort_order' => 4],
            ['name' => 'Aborrajados', 'slug' => 'aborrajados', 'icon' => '🫔', 'gradient' => 'from-burnt-red-500 to-orange-700', 'sort_order' => 5],
            ['name' => 'Bebidas Masato y Avena Caleña', 'slug' => 'bebidas', 'icon' => '🥤', 'gradient' => 'from-warm-orange-600 to-burnt-red-700', 'sort_order' => 6],
            ['name' => 'Combos Familiares', 'slug' => 'combos', 'icon' => '👨‍👩‍👧‍👦', 'gradient' => 'from-warm-orange-600 to-warm-orange-900', 'sort_order' => 7],
        ];

        foreach ($categories as $data) {
            Category::firstOrCreate(['slug' => $data['slug']], $data);
        }

        // Crear productos con referencia a categorías
        $products = [
            ['name' => 'Empanadas Criollas', 'description' => 'Empanadas caseras rellenas de carne molida, papa y cebolla. Crujientes por fuera, jugosas por dentro.', 'price' => 12000, 'stock' => 50, 'icon' => '🥟', 'image_gradient' => 'from-burnt-red-600 to-warm-orange-700', 'category_slug' => 'empanadas', 'is_featured' => true, 'sort_order' => 1],
            ['name' => 'Empanada de Pollo', 'description' => 'Empanada rellena de pollo desmechado con verduras y especias.', 'price' => 10000, 'stock' => 40, 'icon' => '🥟', 'image_gradient' => 'from-burnt-red-500 to-warm-orange-600', 'category_slug' => 'empanadas', 'is_featured' => false, 'sort_order' => 2],
            ['name' => 'Pasteles de Yuca', 'description' => 'Delicias de yuca rellena de queso derretido y carne. Textura suave y sabor inconfundible.', 'price' => 14000, 'stock' => 30, 'icon' => '🍠', 'image_gradient' => 'from-warm-orange-600 to-burnt-red-700', 'category_slug' => 'pasteles', 'is_featured' => true, 'sort_order' => 1],
            ['name' => 'Pastel de Queso y Bocadillo', 'description' => 'Pastel de yuca relleno de queso costeño y bocadillo veleño.', 'price' => 12000, 'stock' => 25, 'icon' => '🥐', 'image_gradient' => 'from-warm-orange-500 to-orange-700', 'category_slug' => 'pasteles', 'is_featured' => false, 'sort_order' => 2],
            ['name' => 'Hamburguesa Criolla', 'description' => 'Hamburguesa artesanal con carne 100% angus, queso, aguacate, tomate y salsa especial.', 'price' => 18000, 'stock' => 35, 'icon' => '🍔', 'image_gradient' => 'from-burnt-red-700 to-burnt-red-900', 'category_slug' => 'hamburguesas', 'is_featured' => true, 'sort_order' => 1],
            ['name' => 'Hamburguesa Ranchera', 'description' => 'Hamburguesa con doble carne, huevo, jamón y queso gratinado.', 'price' => 22000, 'stock' => 20, 'icon' => '🍔', 'image_gradient' => 'from-burnt-red-800 to-burnt-red-950', 'category_slug' => 'hamburguesas', 'is_featured' => false, 'sort_order' => 2],
            ['name' => 'Salchipapas Premium', 'description' => 'Papas crujientes con salchichas fritas, queso derretido y salsas caseras variadas.', 'price' => 16000, 'stock' => 40, 'icon' => '🍟', 'image_gradient' => 'from-warm-orange-700 to-orange-800', 'category_slug' => 'hamburguesas', 'is_featured' => true, 'sort_order' => 3],
            ['name' => 'Arepa de Queso', 'description' => 'Arepa recién hecha con queso blanco casero. Perfecta para desayuno o cualquier hora del día.', 'price' => 10000, 'stock' => 45, 'icon' => '🥕', 'image_gradient' => 'from-burnt-red-500 to-burnt-red-700', 'category_slug' => 'arepas', 'is_featured' => true, 'sort_order' => 1],
            ['name' => 'Arepa de Huevo Tradicional', 'description' => 'Arepa de maíz rellena de huevo, frita a la perfección.', 'price' => 8000, 'stock' => 50, 'icon' => '🍘', 'image_gradient' => 'from-warm-orange-600 to-orange-800', 'category_slug' => 'arepas', 'is_featured' => false, 'sort_order' => 2],
            ['name' => 'Aborrajado Mixto', 'description' => 'Plátano maduro relleno de queso y carne, bañado en hogao casero.', 'price' => 13000, 'stock' => 30, 'icon' => '🫔', 'image_gradient' => 'from-burnt-red-500 to-orange-700', 'category_slug' => 'aborrajados', 'is_featured' => false, 'sort_order' => 1],
            ['name' => 'Aborrajado de Queso', 'description' => 'Plátano maduro relleno de queso mozzarella derretido.', 'price' => 11000, 'stock' => 35, 'icon' => '🫔', 'image_gradient' => 'from-burnt-red-600 to-orange-600', 'category_slug' => 'aborrajados', 'is_featured' => false, 'sort_order' => 2],
            ['name' => 'Masato Tradicional', 'description' => 'Bebida fermentada de arroz con especias, receta tradicional colombiana.', 'price' => 5000, 'stock' => 60, 'icon' => '🥤', 'image_gradient' => 'from-warm-orange-600 to-burnt-red-700', 'category_slug' => 'bebidas', 'is_featured' => false, 'sort_order' => 1],
            ['name' => 'Avena Caleña', 'description' => 'Avena cremosa con leche condensada y canela. Refrescante y nutritiva.', 'price' => 6000, 'stock' => 55, 'icon' => '🥤', 'image_gradient' => 'from-orange-600 to-burnt-red-600', 'category_slug' => 'bebidas', 'is_featured' => false, 'sort_order' => 2],
            ['name' => 'Combo Familiar', 'description' => '4 empanadas + 2 pasteles + 1 hamburguesa + salchipapas + bebidas. Ideal para compartir.', 'price' => 65000, 'stock' => 15, 'icon' => '👨‍👩‍👧‍👦', 'image_gradient' => 'from-warm-orange-600 to-warm-orange-900', 'category_slug' => 'combos', 'is_featured' => true, 'sort_order' => 1],
        ];

        foreach ($products as $data) {
            $categorySlug = $data['category_slug'];
            unset($data['category_slug']);

            $category = Category::where('slug', $categorySlug)->first();
            $data['category_id'] = $category ? $category->id : null;

            Product::firstOrCreate(
                ['name' => $data['name']],
                $data
            );
        }
    }
}
