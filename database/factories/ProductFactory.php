<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    private static array $products = [];

    public function definition(): array
    {
        if (empty(self::$products)) {
            self::$products = [
                ['name' => 'Empanadas Criollas', 'desc' => 'Empanadas caseras rellenas de carne molida, papa y cebolla. Crujientes por fuera, jugosas por dentro.', 'price' => 12000, 'icon' => '🥟', 'gradient' => 'from-burnt-red-600 to-warm-orange-700', 'slug' => 'empanadas', 'featured' => true],
                ['name' => 'Pasteles de Yuca', 'desc' => 'Delicias de yuca rellena de queso derretido y carne. Textura suave y sabor inconfundible.', 'price' => 14000, 'icon' => '🍠', 'gradient' => 'from-warm-orange-600 to-burnt-red-700', 'slug' => 'pasteles', 'featured' => true],
                ['name' => 'Hamburguesa Criolla', 'desc' => 'Hamburguesa artesanal con carne 100% angus, queso, aguacate, tomate y salsa especial.', 'price' => 18000, 'icon' => '🍔', 'gradient' => 'from-burnt-red-700 to-burnt-red-900', 'slug' => 'hamburguesas', 'featured' => true],
                ['name' => 'Salchipapas Premium', 'desc' => 'Papas crujientes con salchichas fritas, queso derretido y salsas caseras variadas.', 'price' => 16000, 'icon' => '🍟', 'gradient' => 'from-warm-orange-700 to-orange-800', 'slug' => 'hamburguesas', 'featured' => true],
                ['name' => 'Arepa de Queso', 'desc' => 'Arepa recién hecha con queso blanco casero. Perfecta para desayuno o cualquier hora del día.', 'price' => 10000, 'icon' => '🥕', 'gradient' => 'from-burnt-red-500 to-burnt-red-700', 'slug' => 'arepas', 'featured' => true],
                ['name' => 'Combo Familiar', 'desc' => '4 empanadas + 2 pasteles + 1 hamburguesa + salchipapas + bebidas. Ideal para compartir.', 'price' => 65000, 'icon' => '👨‍👩‍👧‍👦', 'gradient' => 'from-warm-orange-600 to-warm-orange-900', 'slug' => 'combos', 'featured' => true],
                ['name' => 'Empanada de Pollo', 'desc' => 'Empanada rellena de pollo desmechado con verduras y especias.', 'price' => 10000, 'icon' => '🥟', 'gradient' => 'from-burnt-red-500 to-warm-orange-600', 'slug' => 'empanadas', 'featured' => false],
                ['name' => 'Pastel de Queso y Bocadillo', 'desc' => 'Pastel de yuca relleno de queso costeño y bocadillo veleño.', 'price' => 12000, 'icon' => '🥐', 'gradient' => 'from-warm-orange-500 to-orange-700', 'slug' => 'pasteles', 'featured' => false],
                ['name' => 'Hamburguesa Ranchera', 'desc' => 'Hamburguesa con doble carne, huevo, jamón y queso gratinado.', 'price' => 22000, 'icon' => '🍔', 'gradient' => 'from-burnt-red-800 to-burnt-red-950', 'slug' => 'hamburguesas', 'featured' => false],
                ['name' => 'Arepa de Huevo Tradicional', 'desc' => 'Arepa de maíz rellena de huevo, frita a la perfección.', 'price' => 8000, 'icon' => '🍘', 'gradient' => 'from-warm-orange-600 to-orange-800', 'slug' => 'arepas', 'featured' => false],
                ['name' => 'Aborrajado Mixto', 'desc' => 'Plátano maduro relleno de queso y carne, bañado en hogao casero.', 'price' => 13000, 'icon' => '🫔', 'gradient' => 'from-burnt-red-500 to-orange-700', 'slug' => 'aborrajados', 'featured' => false],
                ['name' => 'Aborrajado de Queso', 'desc' => 'Plátano maduro relleno de queso mozzarella derretido.', 'price' => 11000, 'icon' => '🫔', 'gradient' => 'from-burnt-red-600 to-orange-600', 'slug' => 'aborrajados', 'featured' => false],
                ['name' => 'Masato Tradicional', 'desc' => 'Bebida fermentada de arroz con especias, receta tradicional colombiana.', 'price' => 5000, 'icon' => '🥤', 'gradient' => 'from-warm-orange-600 to-burnt-red-700', 'slug' => 'bebidas', 'featured' => false],
                ['name' => 'Avena Caleña', 'desc' => 'Avena cremosa con leche condensada y canela. Refrescante y nutritiva.', 'price' => 6000, 'icon' => '🥤', 'gradient' => 'from-orange-600 to-burnt-red-600', 'slug' => 'bebidas', 'featured' => false],
            ];
        }

        $product = $this->faker->randomElement(self::$products);

        return [
            'name' => $product['name'],
            'description' => $product['desc'],
            'price' => $product['price'],
            'stock' => $this->faker->numberBetween(10, 100),
            'icon' => $product['icon'],
            'image_gradient' => $product['gradient'],
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'is_featured' => $product['featured'],
            'is_active' => true,
            'sort_order' => $this->faker->numberBetween(1, 20),
        ];
    }
}
