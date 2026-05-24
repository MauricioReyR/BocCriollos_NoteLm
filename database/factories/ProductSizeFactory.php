<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSize>
 */
class ProductSizeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'name' => $this->faker->randomElement(['Tamaño Tradicional', 'Tamaño Bocado']),
            'slug' => $this->faker->randomElement(['tradicional', 'bocado']),
            'price_adjustment' => $this->faker->randomElement([0, -2000, -3000]),
            'is_available' => true,
            'sort_order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
