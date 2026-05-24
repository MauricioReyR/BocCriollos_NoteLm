<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** Imágenes de Unsplash para productos */
    private const IMG_EMPANADAS = 'https://images.unsplash.com/photo-1544250212-0752538b76b1?w=400&h=300&fit=crop';
    private const IMG_EMPANADAS_2 = 'https://images.unsplash.com/photo-1544025162-d76694265447?w=400&h=300&fit=crop';
    private const IMG_PASTELES = 'https://images.unsplash.com/photo-1536768153401-44755106e257?w=400&h=300&fit=crop';
    private const IMG_BURGER = 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&h=300&fit=crop';
    private const IMG_FRIES = 'https://images.unsplash.com/photo-1573080496219-bbc088dc8fcf?w=400&h=300&fit=crop';
    private const IMG_FRIES_2 = 'https://images.unsplash.com/photo-1541592106381-b31e9677c0e5?w=400&h=300&fit=crop';
    private const IMG_AREPAS = 'https://images.unsplash.com/photo-1529692236671-f1f6c938bd0d?w=400&h=300&fit=crop';
    private const IMG_PLANTAIN = 'https://images.unsplash.com/photo-1587320703816-8367fdf51ed8?w=400&h=300&fit=crop';
    private const IMG_DRINK = 'https://images.unsplash.com/photo-1546173159-315724a31696?w=400&h=300&fit=crop';
    private const IMG_DRINK_2 = 'https://images.unsplash.com/photo-1590301157890-4810ed352733?w=400&h=300&fit=crop';
    private const IMG_COMBO = 'https://images.unsplash.com/photo-1506368249639-73a05d6f6488?w=400&h=300&fit=crop';

    public function run(): void
    {
        // ==========================================
        // 1. CREAR CATEGORÍAS PRINCIPALES
        // ==========================================
        $categories = [
            ['name' => 'Empanadas', 'slug' => 'empanadas', 'icon' => '🥟', 'gradient' => 'from-burnt-red-600 to-burnt-red-800', 'sort_order' => 1, 'is_active' => true],
            ['name' => 'Pasteles de Yuca', 'slug' => 'pasteles', 'icon' => '🥐', 'gradient' => 'from-warm-orange-600 to-warm-orange-800', 'sort_order' => 2, 'is_active' => true],
            ['name' => 'Hamburguesas', 'slug' => 'hamburguesas', 'icon' => '🍔', 'gradient' => 'from-burnt-red-700 to-burnt-red-900', 'sort_order' => 3, 'is_active' => true],
            ['name' => 'Arepas Trifásicas', 'slug' => 'arepas', 'icon' => '🍘', 'gradient' => 'from-warm-orange-700 to-orange-900', 'sort_order' => 4, 'is_active' => true],
            ['name' => 'Aborrajados', 'slug' => 'aborrajados', 'icon' => '🫔', 'gradient' => 'from-burnt-red-500 to-orange-700', 'sort_order' => 5, 'is_active' => true],
            ['name' => 'Bebidas', 'slug' => 'bebidas', 'icon' => '🥤', 'gradient' => 'from-warm-orange-600 to-burnt-red-700', 'sort_order' => 6, 'is_active' => true],
            ['name' => 'Combos Familiares', 'slug' => 'combos', 'icon' => '👨‍👩‍👧‍👦', 'gradient' => 'from-warm-orange-600 to-warm-orange-900', 'sort_order' => 7, 'is_active' => false],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(['slug' => $data['slug']], $data);
        }

        // ==========================================
        // 2. CREAR PRODUCTOS
        // ==========================================
        $products = [
            ['name' => 'Empanadas Criollas', 'description' => 'Empanadas caseras rellenas de carne molida, papa y cebolla. Crujientes por fuera, jugosas por dentro.', 'price' => 12000, 'stock' => 50, 'icon' => '🥟', 'image_gradient' => 'from-burnt-red-600 to-warm-orange-700', 'image_url' => self::IMG_EMPANADAS, 'category_slug' => 'empanadas', 'is_featured' => true, 'sort_order' => 1],
            ['name' => 'Empanada de Pollo', 'description' => 'Empanada rellena de pollo desmechado con verduras y especias.', 'price' => 10000, 'stock' => 40, 'icon' => '🥟', 'image_gradient' => 'from-burnt-red-500 to-warm-orange-600', 'image_url' => self::IMG_EMPANADAS_2, 'category_slug' => 'empanadas', 'is_featured' => false, 'sort_order' => 2],
            ['name' => 'Pasteles de Yuca', 'description' => 'Delicias de yuca rellena de queso derretido y carne. Textura suave y sabor inconfundible.', 'price' => 14000, 'stock' => 30, 'icon' => '🍠', 'image_gradient' => 'from-warm-orange-600 to-burnt-red-700', 'image_url' => self::IMG_PASTELES, 'category_slug' => 'pasteles', 'is_featured' => true, 'sort_order' => 1],
            ['name' => 'Pastel de Queso y Bocadillo', 'description' => 'Pastel de yuca relleno de queso costeño y bocadillo veleño.', 'price' => 12000, 'stock' => 25, 'icon' => '🥐', 'image_gradient' => 'from-warm-orange-500 to-orange-700', 'image_url' => self::IMG_PASTELES, 'category_slug' => 'pasteles', 'is_featured' => false, 'sort_order' => 2],
            ['name' => 'Hamburguesa Criolla', 'description' => 'Hamburguesa artesanal con carne 100% angus, queso, aguacate, tomate y salsa especial.', 'price' => 18000, 'stock' => 35, 'icon' => '🍔', 'image_gradient' => 'from-burnt-red-700 to-burnt-red-900', 'image_url' => self::IMG_BURGER, 'category_slug' => 'hamburguesas', 'is_featured' => true, 'sort_order' => 1],
            ['name' => 'Hamburguesa Ranchera', 'description' => 'Hamburguesa con doble carne, huevo, jamón y queso gratinado.', 'price' => 22000, 'stock' => 20, 'icon' => '🍔', 'image_gradient' => 'from-burnt-red-800 to-burnt-red-950', 'image_url' => self::IMG_BURGER, 'category_slug' => 'hamburguesas', 'is_featured' => false, 'sort_order' => 2],
            ['name' => 'Salchipapas Premium', 'description' => 'Papas crujientes con salchichas fritas, queso derretido y salsas caseras variadas.', 'price' => 16000, 'stock' => 40, 'icon' => '🍟', 'image_gradient' => 'from-warm-orange-700 to-orange-800', 'image_url' => self::IMG_FRIES, 'category_slug' => 'hamburguesas', 'is_featured' => true, 'sort_order' => 3],
            ['name' => 'Arepa de Queso', 'description' => 'Arepa recién hecha con queso blanco casero. Perfecta para desayuno o cualquier hora del día.', 'price' => 10000, 'stock' => 45, 'icon' => '🥕', 'image_gradient' => 'from-burnt-red-500 to-burnt-red-700', 'image_url' => self::IMG_AREPAS, 'category_slug' => 'arepas', 'is_featured' => true, 'sort_order' => 1],
            ['name' => 'Arepa de Huevo Tradicional', 'description' => 'Arepa de maíz rellena de huevo, frita a la perfección.', 'price' => 8000, 'stock' => 50, 'icon' => '🍘', 'image_gradient' => 'from-warm-orange-600 to-orange-800', 'image_url' => self::IMG_AREPAS, 'category_slug' => 'arepas', 'is_featured' => false, 'sort_order' => 2],
            ['name' => 'Aborrajado Mixto', 'description' => 'Plátano maduro relleno de queso y carne, bañado en hogao casero.', 'price' => 13000, 'stock' => 30, 'icon' => '🫔', 'image_gradient' => 'from-burnt-red-500 to-orange-700', 'image_url' => self::IMG_PLANTAIN, 'category_slug' => 'aborrajados', 'is_featured' => false, 'sort_order' => 1],
            ['name' => 'Aborrajado de Queso', 'description' => 'Plátano maduro relleno de queso mozzarella derretido.', 'price' => 11000, 'stock' => 35, 'icon' => '🫔', 'image_gradient' => 'from-burnt-red-600 to-orange-600', 'image_url' => self::IMG_PLANTAIN, 'category_slug' => 'aborrajados', 'is_featured' => false, 'sort_order' => 2],
            ['name' => 'Masato de Arroz (Casero)', 'description' => 'Masato de arroz casero, preparado con la receta tradicional colombiana. Cremoso y delicioso.', 'price' => 5000, 'stock' => 60, 'icon' => '🥤', 'image_gradient' => 'from-warm-orange-600 to-burnt-red-700', 'image_url' => self::IMG_DRINK, 'category_slug' => 'bebidas', 'is_featured' => false, 'sort_order' => 1],
            ['name' => 'Avena Caleña', 'description' => 'Avena cremosa con leche condensada y canela, bien fría. Refrescante y nutritiva.', 'price' => 6000, 'stock' => 55, 'icon' => '🥤', 'image_gradient' => 'from-orange-600 to-burnt-red-600', 'image_url' => self::IMG_DRINK_2, 'category_slug' => 'bebidas', 'is_featured' => false, 'sort_order' => 2],
            ['name' => 'Combo Familiar', 'description' => '4 empanadas + 2 pasteles + 1 hamburguesa + salchipapas + bebidas. Ideal para compartir.', 'price' => 65000, 'stock' => 15, 'icon' => '👨‍👩‍👧‍👦', 'image_gradient' => 'from-warm-orange-600 to-warm-orange-900', 'image_url' => self::IMG_COMBO, 'category_slug' => 'combos', 'is_featured' => true, 'sort_order' => 1],
            ['name' => 'Combo Tradicional', 'description' => '12 crujientes y deliciosas empanadas vallunas 🤤 con aji criollo🥵 y salsa casera tipo chimichurri😏. Disfruta esta delicia en casa🏡, calientitas y crujientes 🛵 pide tu domicilio ahora 😎', 'price' => 30000, 'stock' => 20, 'icon' => '🥟', 'image_gradient' => 'from-warm-orange-600 to-burnt-red-700', 'image_url' => self::IMG_COMBO, 'category_slug' => 'combos', 'is_featured' => false, 'sort_order' => 2],
            ['name' => 'Combo Megacombo', 'description' => '¡¡¡MEGACOMBO!!! ⚠️ 6 crujientes y deliciosas😋 empanadas tradicionales y 4 arepas de huevo 🍳 trifasicas con pollo 🍗 desmechado y carne 🥩 desmechada.', 'price' => 38000, 'stock' => 15, 'icon' => '🫓', 'image_gradient' => 'from-burnt-red-600 to-warm-orange-700', 'image_url' => self::IMG_COMBO, 'category_slug' => 'combos', 'is_featured' => false, 'sort_order' => 3],
            ['name' => 'Combo Cerpincho', 'description' => '3 deliciosos pinchos 🍢 con chicharroncito carnudito con papa salada, jugosa carne de cerdo y plátano maduro delicioso💯.', 'price' => 45000, 'stock' => 15, 'icon' => '🍢', 'image_gradient' => 'from-burnt-red-700 to-burnt-red-900', 'image_url' => self::IMG_FRIES_2, 'category_slug' => 'combos', 'is_featured' => false, 'sort_order' => 4],
            ['name' => 'Combo Familia Pequeña', 'description' => '4 empanadas + 2 pasteles + 1 hamburguesa. El combo para la familia reunida.', 'price' => 62000, 'stock' => 10, 'icon' => '👨‍👩‍👧', 'image_gradient' => 'from-warm-orange-700 to-orange-800', 'image_url' => self::IMG_COMBO, 'category_slug' => 'combos', 'is_featured' => false, 'sort_order' => 5],
            ['name' => 'Combo Vegetariano', 'description' => '3 arepas de queso + 2 tostadas criollas + bebida. Delicioso sin sacrificar sabor.', 'price' => 32000, 'stock' => 20, 'icon' => '🥕', 'image_gradient' => 'from-burnt-red-500 to-burnt-red-700', 'image_url' => self::IMG_AREPAS, 'category_slug' => 'combos', 'is_featured' => false, 'sort_order' => 6],
            ['name' => 'Combo Fiesta (8 pax)', 'description' => '12 empanadas + 6 pasteles + 2 hamburguesas + salchipapas + 4 bebidas. ¡Para celebrar!', 'price' => 120000, 'stock' => 5, 'icon' => '🎉', 'image_gradient' => 'from-warm-orange-600 to-warm-orange-900', 'image_url' => self::IMG_COMBO, 'category_slug' => 'combos', 'is_featured' => false, 'sort_order' => 7],
        ];

        foreach ($products as $data) {
            $categorySlug = $data['category_slug'];
            unset($data['category_slug']);

            $category = Category::where('slug', $categorySlug)->first();
            $data['category_id'] = $category ? $category->id : null;

            Product::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }

        // ==========================================
        // 3. CREAR TAMAÑOS PARA EMPANADAS Y PASTELES
        // ==========================================
        $sizes = [
            // Empanadas
            ['product_name' => 'Empanadas Criollas', 'sizes' => [
                ['name' => 'Tamaño Tradicional', 'slug' => 'tradicional', 'price_adjustment' => 0, 'sort_order' => 1],
                ['name' => 'Tamaño Bocado', 'slug' => 'bocado', 'price_adjustment' => -2000, 'sort_order' => 2],
            ]],
            ['product_name' => 'Empanada de Pollo', 'sizes' => [
                ['name' => 'Tamaño Tradicional', 'slug' => 'tradicional', 'price_adjustment' => 0, 'sort_order' => 1],
                ['name' => 'Tamaño Bocado', 'slug' => 'bocado', 'price_adjustment' => -2000, 'sort_order' => 2],
            ]],
            // Pasteles
            ['product_name' => 'Pasteles de Yuca', 'sizes' => [
                ['name' => 'Tamaño Tradicional', 'slug' => 'tradicional', 'price_adjustment' => 0, 'sort_order' => 1],
                ['name' => 'Tamaño Bocado', 'slug' => 'bocado', 'price_adjustment' => -3000, 'sort_order' => 2],
            ]],
            ['product_name' => 'Pastel de Queso y Bocadillo', 'sizes' => [
                ['name' => 'Tamaño Tradicional', 'slug' => 'tradicional', 'price_adjustment' => 0, 'sort_order' => 1],
                ['name' => 'Tamaño Bocado', 'slug' => 'bocado', 'price_adjustment' => -2000, 'sort_order' => 2],
            ]],
        ];

        foreach ($sizes as $entry) {
            $product = Product::where('name', $entry['product_name'])->first();
            if ($product) {
                foreach ($entry['sizes'] as $sizeData) {
                    ProductSize::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'slug' => $sizeData['slug'],
                        ],
                        [
                            'name' => $sizeData['name'],
                            'price_adjustment' => $sizeData['price_adjustment'],
                            'sort_order' => $sizeData['sort_order'],
                            'is_available' => true,
                        ]
                    );
                }
            }
        }
    }
}
