<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Combo>
 */
class ComboFactory extends Factory
{
    private static array $sizes = ['tradicional', 'bocado'];

    public function definition(): array
    {
        $adjective = $this->faker->randomElement(['Delicioso', 'Especial', 'Super', 'Mega', 'Familiar', 'Clásico']);
        $food = $this->faker->randomElement(['Empanadas', 'Combos', 'Pastelitos', 'Arepas']);

        return [
            'name' => "Combo {$adjective} {$food}",
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomElement([25000, 30000, 35000, 45000, 55000]),
            'is_active' => true,
            'is_featured' => $this->faker->boolean(30),
            'sort_order' => $this->faker->numberBetween(1, 10),
            'size' => $this->faker->optional(0.7)->randomElement(self::$sizes),
        ];
    }
}
