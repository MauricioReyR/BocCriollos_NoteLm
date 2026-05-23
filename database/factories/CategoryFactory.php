<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $categories = [
            'Empanadas Tradicionales y Bocado' => ['slug' => 'empanadas', 'icon' => '🥟', 'gradient' => 'from-burnt-red-600 to-burnt-red-800'],
            'Pasteles de Yuca tipo Bocado' => ['slug' => 'pasteles', 'icon' => '🥐', 'gradient' => 'from-warm-orange-600 to-warm-orange-800'],
            'Hamburguesas' => ['slug' => 'hamburguesas', 'icon' => '🍔', 'gradient' => 'from-burnt-red-700 to-burnt-red-900'],
            'Arepas Trifasicas Tradicionales y Tipo Bocado' => ['slug' => 'arepas', 'icon' => '🍘', 'gradient' => 'from-warm-orange-700 to-orange-900'],
            'Aborrajados' => ['slug' => 'aborrajados', 'icon' => '🫔', 'gradient' => 'from-burnt-red-500 to-orange-700'],
            'Bebidas Masato y Avena Caleña' => ['slug' => 'bebidas', 'icon' => '🥤', 'gradient' => 'from-warm-orange-600 to-burnt-red-700'],
            'Combos Familiares' => ['slug' => 'combos', 'icon' => '👨‍👩‍👧‍👦', 'gradient' => 'from-warm-orange-600 to-warm-orange-900'],
        ];

        $name = $this->faker->unique()->randomElement(array_keys($categories));
        $data = $categories[$name];

        return [
            'name' => $name,
            'slug' => $data['slug'],
            'description' => $this->faker->sentence(),
            'icon' => $data['icon'],
            'gradient' => $data['gradient'],
            'sort_order' => $this->faker->numberBetween(1, 10),
            'is_active' => true,
        ];
    }
}
